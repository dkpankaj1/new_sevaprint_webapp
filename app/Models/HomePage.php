<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = ['image'];

    public function getImageAttribute($value){
        return $value ? asset($value) : "https://placehold.co/819x674";
    }
}
