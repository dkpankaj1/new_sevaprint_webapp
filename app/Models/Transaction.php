<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "user_id",
        "transaction_type",
        "transaction_direction",
        "vendor",
        "transaction_id",
        "opening_balance",
        "amount",
        "fee",
        "tax",
        "closing_balance",
        "currency_id",
        "payment_method",
        "status",
        "metadata",
        "ip_address",
        "user_agent",
        "processed_at",
    ];
    protected $casts = [
        'metadata' => 'array',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
