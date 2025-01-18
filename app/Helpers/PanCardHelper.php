<?php

namespace App\Helpers;

use App\Models\PanCard;

class PanCardHelper
{
    public static function generateOrderId(): string
    {
        do {
            $orderId = 'P' . str_pad((string) random_int(0, 9999999), 15, '0', STR_PAD_LEFT);
            $exists = PanCard::where('unique_id', $orderId)->exists();
        } while ($exists);
        return $orderId;
    }
}
