<?php

namespace App\Helpers;

use App\Models\GeneralSetting;
use App\Models\Transaction;

class TransactionHelper
{
    public static function getCurrency()
    {
        $generalSetting = GeneralSetting::first();
        return $generalSetting->currency;
    }
    public static function generateTransactionId(): string
    {
        do {
            // Generate a random transaction ID
            $transactionId = 'TNX' . str_pad((string) random_int(0, 9999999), 7, '0', STR_PAD_LEFT);

            // Check if the transaction ID is unique
            $exists = Transaction::where('transaction_id', $transactionId)->exists();
        } while ($exists);

        return $transactionId;
    }

    //     $user->decrement('wallet', $amount);
// $user->increment('wallet', $amount);

}
