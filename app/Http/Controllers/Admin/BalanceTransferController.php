<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TransactionEnum;
use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BalanceTransferController extends Controller
{
    protected $generalSetting;

    public function __construct()
    {

        $this->generalSetting = GeneralSetting::with('currency')->first();
    }
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $balanceTransferQuery = BalanceTransfer::query()->orderBy('id', 'desc');
            return DataTables::eloquent($balanceTransferQuery)
                ->addIndexColumn()
                ->addColumn('user', fn($balanceTransfer) => $balanceTransfer->user->name)
                ->addColumn('email', fn($balanceTransfer) => $balanceTransfer->user->email)
                ->addColumn('amount', function ($balanceTransfer) {
                    $currencySymbol = $this->generalSetting->currency->symbol ?? '';
                    return "{$currencySymbol} {$balanceTransfer->amount}";
                })
                ->addColumn('status', function ($balanceTransfer) {
                    $badgeType = match ($balanceTransfer->status) {
                        'complete' => 'success',
                        'pending' => 'info',
                        'failed' => 'danger',
                        default => 'secondary',
                    };
                    return view('components.badges', [
                        'type' => $badgeType,
                        'text' => ucfirst($balanceTransfer->status),
                    ]);
                })

                ->addColumn('created_at', fn($balanceTransfer) => $balanceTransfer->created_at->diffForHumans())
                ->addColumn('updated_at', fn($balanceTransfer) => $balanceTransfer->updated_at->diffForHumans())
                ->addColumn('action', function ($balanceTransfer) {
                    return view('components.show-btn', ['url' => route('admin.balance-transfer.show', $balanceTransfer)]) .
                        view('components.edit-btn', ['url' => route('admin.balance-transfer.edit', $balanceTransfer)]) .
                        view('components.delete-btn', ['url' => route('admin.balance-transfer.destroy', $balanceTransfer)]);
                })
                ->make(true);
        }

        return view('admin.balance-transfer.index');
    }
    public function create(Request $request)
    {
        $users = User::where(['is_active' => true])->get();
        return view('admin.balance-transfer.create', ['users' => $users]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user' => ['required', 'integer', Rule::exists('users', 'id')],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'user.required' => 'User is required.',
            'user.exists' => 'The selected user does not exist.',
            'amount.required' => 'Amount is required.',
            'amount.min' => 'Amount must be at least 0.01.',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($validated['user']);
            $adminId = Auth::guard('admin')->id();
            $transactionId = md5(uniqid(time(), true));
            $currency = $this->generalSetting->currency->code;

            // Create Transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'transaction_type' => TransactionEnum::TYPE_WALLET,
                'transaction_direction' => TransactionEnum::DIRECTION_CREDIT,
                'transaction_id' => $transactionId,
                'opening_balance' => $user->wallet,
                'amount' => $validated['amount'],
                'fee' => 0,
                'tax' => 0,
                'net_amount' => $validated['amount'],
                'closing_balance' => $user->wallet + $validated['amount'],
                'currency' => $currency,
                'payment_method' => 'wallet',
                'status' => TransactionEnum::STATUS_COMPLETE,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Create Balance Transfer Record
            BalanceTransfer::create([
                'admin_id' => $adminId,
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
                'amount' => $validated['amount'],
                'notes' => $validated['notes'],
                'status' => "complete"
            ]);

            // Update User Wallet Balance
            $user->increment('wallet', $validated['amount']);

            DB::commit();

            return redirect()->route('admin.balance-transfer.index')
                ->with(['message' => 'Balance transfer successful', 'type' => 'success']);

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Balance transfer failed.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->route('admin.balance-transfer.index')
                ->with(['message' => 'An error occurred during balance transfer. Please try again.', 'type' => 'error']);
        }
    }


    public function show(BalanceTransfer $balance_transfer)
    {
        $balance_transfer->load([
            "admin",
            "transaction",
            "user"
        ]);
        return view('admin.balance-transfer.show', [
            "balanceTransfer" => $balance_transfer
        ]);
    }
    public function edit(Request $request, BalanceTransfer $balance_transfer)
    {
        $balance_transfer->load([
            "admin",
            "transaction",
            "user"
        ]);
        $users = User::where(['is_active' => true])->get();
        return view(
            'admin.balance-transfer.edit',
            ["balanceTransfer" => $balance_transfer, 'users' => $users]
        );
    }
    public function update(Request $request, BalanceTransfer $balance_transfer)
    {
        $request->validate([
            'user' => ['required', 'integer', Rule::exists('users', 'id')],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        DB::beginTransaction();

        try {
            $currency = $this->generalSetting->currency->code;

            // restore user wallet
            $transaction = Transaction::create([
                'user_id' => $balance_transfer->user->id,
                'transaction_type' => TransactionEnum::TYPE_WALLET,
                'transaction_direction' => TransactionEnum::DIRECTION_DEBIT,
                'transaction_id' => md5(uniqid(time(), true)),
                'opening_balance' => $balance_transfer->user->wallet,
                'amount' => $balance_transfer->amount,
                'fee' => 0,
                'tax' => 0,
                'net_amount' => $balance_transfer->amount,
                'closing_balance' => $balance_transfer->user->wallet - $balance_transfer->amount,
                'currency' => $currency,
                'payment_method' => 'wallet',
                'status' => TransactionEnum::STATUS_COMPLETE,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            $balance_transfer->user->decrement('wallet', $balance_transfer->amount);



            $user = User::findOrFail($request->user);
            $adminId = Auth::guard('admin')->id();
            $transactionId = md5(uniqid(time(), true));

            // Create Transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'transaction_type' => TransactionEnum::TYPE_WALLET,
                'transaction_direction' => TransactionEnum::DIRECTION_CREDIT,
                'transaction_id' => $transactionId,
                'opening_balance' => $user->wallet,
                'amount' => $request->amount,
                'fee' => 0,
                'tax' => 0,
                'net_amount' => $request->amount,
                'closing_balance' => $user->wallet + $request->amount,
                'currency' => $currency,
                'payment_method' => 'wallet',
                'status' => TransactionEnum::STATUS_COMPLETE,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Update Balance Transfer Record
            $balance_transfer->update([
                'admin_id' => $adminId,
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
                'amount' => $request->amount,
                'notes' => $request->notes,
                'status' => "complete"
            ]);

            // Update User Wallet Balance
            $user->increment('wallet', $request->amount);

            DB::commit();

            return redirect()->route('admin.balance-transfer.index')
                ->with(['message' => 'Balance transfer successful', 'type' => 'success']);

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Balance transfer failed.', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->route('admin.balance-transfer.index')
                ->with(['message' => 'An error occurred during balance transfer. Please try again.', 'type' => 'error']);
        }

    }
    public function destroy(BalanceTransfer $balance_transfer)
    {
    }
}
