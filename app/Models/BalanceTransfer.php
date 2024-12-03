<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceTransfer extends Model
{
    protected $fillable = [
        "admin_id",
        "user_id",
        "transaction_id",
        "amount",
        "notes",
        "status",
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
