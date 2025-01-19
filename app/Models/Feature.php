<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Feature extends Model 
{

    protected $fillable = [
        "code",
        "name",
        "icon",
        "description",
        "fee",
        "commission",
        "commission_type",
        "enable",
    ];

    public function getIconAttribute($value){
        return $value ? asset($value) : "https://placehold.co/200x113";
    }
}
