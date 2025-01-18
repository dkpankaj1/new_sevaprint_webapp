<?php

namespace App\Features;

use App\Models\Feature;

abstract class BaseFeature
{
    protected static $code;
    public static function isEnabled(): bool
    {
        $feature = Feature::where('code', static::$code)->first();
        return $feature ? $feature->enable : false;
    }
    public static function getFeatureCode(): string
    {
        return static::$code;
    }
    public static function getFeatureCharges(): float
    {
        $feature = Feature::where('code', static::$code)->first();
        return $feature ? $feature->fee : 0.0;
    }
}
