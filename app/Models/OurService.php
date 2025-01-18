<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'is_active'];

    public function getIconAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/45";
    }
}
