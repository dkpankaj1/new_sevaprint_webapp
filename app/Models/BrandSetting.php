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
        "logo_light",
        "logo_dark",
        "favicon",
        "contact_email",
        "contact_phone",
    ];

    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : 'https://placehold.co/94x99';
    }

    public function getLogoLightAttribute($value)
    {
        return $value ? asset($value) : 'https://placehold.co/244x68';
    }
    public function getLogoDarkAttribute($value)
    {
        return $value ? asset($value) : 'https://placehold.co/244x68';
    }
    public function getFaviconAttribute($value)
    {
        return $value ? asset($value) : 'https://placehold.co/32x32';
    }
}
