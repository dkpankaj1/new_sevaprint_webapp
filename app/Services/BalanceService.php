<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class BalanceService
{
    /**
     * Check if the user has sufficient balance.
     *
     * @param float $amount
     * @return bool
     */
    public function hasSufficientBalance(float $amount): bool
    {
        return Gate::allows('checkBalance', [$amount]);
    }

    /**
     * Handle insufficient balance scenario.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleLowBalanceResponse()
    {
        return redirect()->route('wallet.recharge')->with([
            'message' => 'Low Balance',
            'type' => 'error',
        ]);
    }
}
