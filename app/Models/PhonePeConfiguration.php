<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhonePeConfiguration extends Model
{
    protected $fillable = [
        "name",
        "description",
        "logo",
        "merchant_id",
        "salt_key",
        "salt_index",
        "enable",
    ];
    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/100x100";
    }
}
