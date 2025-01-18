<?php

namespace App\Helpers;

use App\Models\MobileRecharge;

class RechargeHelper
{
    public static function generateOrderId(): string
    {
        do {
            $orderId = 'RHG' . str_pad((string) random_int(0, 9999999), 7, '0', STR_PAD_LEFT);
            $exists = MobileRecharge::where('uniqid', $orderId)->exists();
        } while ($exists);
        return $orderId;
    }
}
