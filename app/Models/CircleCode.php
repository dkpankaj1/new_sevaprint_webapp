<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CircleCode extends Model
{
    protected $fillable = [
        "code",
        "plan_api_code",
        "name",
    ];
}
