<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        "date_format",
        "default_currency",
        "timezone",
        "maintenance_mode",
        "language",
        "session_timeout",
        "copyright",
        "developed_by",
    ];
}
