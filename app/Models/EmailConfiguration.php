<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    protected $fillable = [
        "email_enable",
        "smtp_host",
        "smtp_port",
        "smtp_username",
        "smtp_password",
        "smtp_encryption",
        "from_address",
        "from_name",
        "reply_to_address",
        "reply_to_name",
        "is_active",
    ];
}
