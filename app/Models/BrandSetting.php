<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSetting extends Model
{
    protected $fillable = [
        "name",
        "title",
        "description",
        "logo",
        "logo_main",
        "favicon",
        "contact_email",
        "contact_phone",
    ];

    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : asset('avatar/user.jpg');
    }

    public function getLogoMainAttribute($value)
    {
        return $value ? asset($value) : asset('avatar/user.jpg');
    }

    public function getFaviconAttribute($value)
    {
        return $value ? asset($value) : asset('avatar/user.jpg');
    }
}
