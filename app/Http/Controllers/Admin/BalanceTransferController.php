<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Services\Contracts\BalanceTransferServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BalanceTransferController extends Controller
{
    protected $generalSetting;
    protected $balanceTransferService;
    public function __construct(BalanceTransferServiceInterface $balanceTransferServiceInterface)
    {
        $this->balanceTransferService = $balanceTransferServiceInterface;
        $this->generalSetting = GeneralSetting::with('currency')->first();
    }
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->balanceTransferService->getDataTableData();
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

        $balanceTransfer = $this->balanceTransferService->storeBalanceTransfer($validated);

        if ($balanceTransfer) {
            return redirect()->route('admin.balance-transfer.index')
                ->with(['message' => 'Balance transfer successful', 'type' => 'success']);
        }

        return redirect()->route('admin.balance-transfer.index')
            ->with(['message' => 'An error occurred during balance transfer. Please try again.', 'type' => 'error']);

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
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $balanceTransfer = $this->balanceTransferService->updateBalanceTransfer($validated, $balance_transfer);

        if ($balanceTransfer) {
            return redirect()->route('admin.balance-transfer.index')
                ->with(['message' => 'Balance transfer successful', 'type' => 'success']);
        }

        return redirect()->route('admin.balance-transfer.index')
            ->with(['message' => 'An error occurred during balance transfer. Please try again.', 'type' => 'error']);

    }

    public function destroy(BalanceTransfer $balance_transfer)
    {
        
    }
}
