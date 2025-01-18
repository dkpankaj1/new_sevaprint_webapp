<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NicePeConfiguration extends Model
{
    protected $fillable = [
        "name",
        "description",
        "logo",
        "upi_id",
        "token",
        "secret_key",
        "base_url",
        "enable",
    ];
    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/100x100";
    }
}
