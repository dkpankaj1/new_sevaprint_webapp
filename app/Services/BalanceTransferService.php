<?php
namespace App\Services;

use App\Enums\TransactionEnum;
use App\Helpers\TransactionHelper;
use App\Models\BalanceTransfer;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Contracts\BalanceTransferRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Services\Contracts\BalanceTransferServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BalanceTransferService implements BalanceTransferServiceInterface
{
    protected $balanceTransferRepository;
    protected $transactionRepository;
    public function __construct(
        BalanceTransferRepositoryInterface $balanceTransferRepositoryInterface,
        TransactionRepositoryInterface $transactionRepositoryInterface
    ) {
        $this->balanceTransferRepository = $balanceTransferRepositoryInterface;
        $this->transactionRepository = $transactionRepositoryInterface;
    }
    public function getDataTableData(): JsonResponse
    {
        $balanceTransferQuery = $this->balanceTransferRepository->query()
            ->orderBy('id', 'desc');

        return DataTables::eloquent($balanceTransferQuery)
            ->addIndexColumn()
            ->addColumn('user', fn($balanceTransfer) => $balanceTransfer->user->name)
            ->addColumn('email', fn($balanceTransfer) => $balanceTransfer->user->email)
            ->addColumn('amount', function ($balanceTransfer) {
                $currencySymbol = $balanceTransfer->transaction->currency->symbol ?? '';
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
                    view('components.edit-btn', ['url' => route('admin.balance-transfer.edit', $balanceTransfer)]);
            })
            ->make(true);
    }
    public function storeBalanceTransfer(array $validated):?BalanceTransfer
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($validated['user']);
            $adminId = Auth::guard('admin')->id();
            $transaction = $this->transactionRepository->create([
                "user_id" => $user->id,
                "transaction_type" => TransactionEnum::TYPE_INTERNAL,
                "transaction_direction" => TransactionEnum::DIRECTION_CREDIT,
                "vendor" => TransactionEnum::VENDOR_INTERNAL,
                "transaction_id" => TransactionHelper::generateTransactionId(),
                "opening_balance" => $user->wallet,
                'amount' => $validated['amount'],
                'fee' => 0,
                'tax' => 0,
                'closing_balance' => $user->wallet + $validated['amount'],
                'currency_id' => TransactionHelper::getCurrency()->id,
                "payment_method" => TransactionEnum::METHOD_WALLET,
                'status' => TransactionEnum::STATUS_COMPLETE,
                'metadata' => ['message' => "wallet recharge by admin"],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            // Create Balance Transfer Record
            $balanceTransfer = $this->balanceTransferRepository->create([
                'admin_id' => $adminId,
                'user_id' => $user->id,
                'transaction_id' => $transaction->id,
                'amount' => $validated['amount'],
                'notes' => $validated['notes'],
                'status' => "complete"
            ]);
            $user->increment('wallet', $validated['amount']);
            DB::commit();
            return $balanceTransfer;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Balance transfer failed.', ['error' => $e->getMessage()]);
            return null;
        }
    }
    public function updateBalanceTransfer(array $validated, BalanceTransfer $balance_transfer): ?BalanceTransfer
    {
        DB::beginTransaction();
        
        try {
            $adminId = Auth::guard('admin')->id();
            $user = $balance_transfer->user;

            // Debit Transaction
            $debitTransaction = $this->transactionRepository->create([
                'user_id' => $user->id,
                'transaction_type' => TransactionEnum::TYPE_INTERNAL,
                'transaction_direction' => TransactionEnum::DIRECTION_DEBIT,
                'vendor' => TransactionEnum::VENDOR_INTERNAL,
                'transaction_id' => TransactionHelper::generateTransactionId(),
                'opening_balance' => $user->wallet,
                'amount' => $balance_transfer->amount,
                'fee' => 0,
                'tax' => 0,
                'closing_balance' => $user->wallet - $balance_transfer->amount,
                'currency_id' => TransactionHelper::getCurrency()->id,
                'payment_method' => TransactionEnum::METHOD_WALLET,
                'status' => TransactionEnum::STATUS_COMPLETE,
                'metadata' => ['message' => 'Wallet restored by admin'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $user->decrement('wallet', $balance_transfer->amount);

            // Credit Transaction
            $creditTransaction = $this->transactionRepository->create([
                'user_id' => $user->id,
                'transaction_type' => TransactionEnum::TYPE_INTERNAL,
                'transaction_direction' => TransactionEnum::DIRECTION_CREDIT,
                'vendor' => TransactionEnum::VENDOR_INTERNAL,
                'transaction_id' => TransactionHelper::generateTransactionId(),
                'opening_balance' => $user->wallet,
                'amount' => $validated['amount'],
                'fee' => 0,
                'tax' => 0,
                'closing_balance' => $user->wallet + $validated['amount'],
                'currency_id' => TransactionHelper::getCurrency()->id,
                'payment_method' => TransactionEnum::METHOD_WALLET,
                'status' => TransactionEnum::STATUS_COMPLETE,
                'metadata' => ['message' => 'Wallet recharged by admin'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $user->increment('wallet', $validated['amount']);

            // Update Balance Transfer Record
            $balance_transfer->update([
                'admin_id' => $adminId,
                'transaction_id' => $creditTransaction->id,
                'amount' => $validated['amount'],
                'notes' => $validated['notes'],
                'status' => 'complete',
            ]);

            DB::commit();

            return $balance_transfer;

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Balance transfer failed.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return null;
        }
    }
}