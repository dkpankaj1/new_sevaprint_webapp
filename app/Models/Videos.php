<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'url',
        'is_active',
    ];
}
