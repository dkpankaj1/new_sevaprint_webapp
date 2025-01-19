<?php

namespace App\Features;

use App\Models\Feature;

class MobileRechargeFeature extends BaseFeature
{
    protected static $code = 'FTR001';

    public static function finalCharges(float $amount): float
    {
        $feature = Feature::where('code', static::$code)->first();

        if (!$feature) {return $amount;}

        $commission = $feature->commission_type === 0
            ? $feature->commission
            : ($amount * $feature->commission) / 100;

        return $amount - $commission;
    }
}
