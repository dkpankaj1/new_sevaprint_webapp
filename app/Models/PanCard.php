<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanCard extends Model
{
    protected $fillable = [
        "user_id",
        "unique_id",
        "application_mode",
        "application_type",
        "acknowledgement_no",
        "category",
        "branch_code",
        "name",
        "gender",
        "mobile",
        "email",
        "pan_type",
        "consent",
        "transaction_fee",
        "order_id",
        "authorization",
        "authorization_at",
        "message",
        "status",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
