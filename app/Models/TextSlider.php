<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextSlider extends Model
{
    protected $fillable = ['title', 'sub_title', 'description', 'is_active'];
}
