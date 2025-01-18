<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RazorPayConfiguration extends Model
{
    protected $fillable = [
        "name",
        "description",
        "logo",
        "api_key",
        "api_secret",
        "webhook_secret",
        "enable",
    ];
    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/100x100";
    }
}
