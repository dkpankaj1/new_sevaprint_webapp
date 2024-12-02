<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NicePeConfiguration extends Model
{
    protected $fillable = [
        "name",
        "description",
        "logo",
        "api_key",
        "secret_key",
        "enable",
    ];
    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : "";
    }
}
