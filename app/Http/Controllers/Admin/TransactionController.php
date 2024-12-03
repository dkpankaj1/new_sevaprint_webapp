<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    protected $generalSetting;

    public function __construct()
    {
        $this->generalSetting = GeneralSetting::with('currency')->first();
    }
    public function index(Request $request)
    {
        if ($request->expectsJson()) {

            $transactionsQuery = Transaction::query()->orderBy('id', 'desc');
            return DataTables::eloquent($transactionsQuery)
                ->addIndexColumn()
                ->addColumn('user', fn($transaction) => $transaction->user->name)
                ->addColumn('email', fn($transaction) => $transaction->user->email)

                ->addColumn('opening_balance', function ($transaction) {
                    $currencySymbol = $this->generalSetting->currency->symbol ?? '';
                    return "{$currencySymbol} {$transaction->opening_balance}";
                })

                ->addColumn('net_amount', function ($transaction) {
                    $currencySymbol = $this->generalSetting->currency->symbol ?? '';
                    return "{$currencySymbol} {$transaction->net_amount}";
                })

                ->addColumn('closing_balance', function ($transaction) {
                    $currencySymbol = $this->generalSetting->currency->symbol ?? '';
                    return "{$currencySymbol} {$transaction->closing_balance}";
                })

                ->addColumn('status', function ($transaction) {
                    $badgeType = match ($transaction->status) {
                        'complete' => 'success',
                        'pending' => 'info',
                        'failed' => 'danger',
                        default => 'secondary',
                    };
                    return view('components.badges', [
                        'type' => $badgeType,
                        'text' => ucfirst($transaction->status),
                    ]);
                })
                ->addColumn('action', function ($transaction) {
                    return view('components.show-btn', ['url' => route('admin.transaction.show', $transaction->id)]);
                })
                ->make(true);
        }


        return view('admin.transaction.index');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user']);
        return view('admin.transaction.show', ['transaction' => $transaction]);
    }
}
