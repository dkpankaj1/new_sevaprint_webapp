<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileRecharge extends Model
{
    protected $fillable = [
        "uniqid",
        "user_id",
        "mobile_number",
        "currency_id",
        "amount",
        "operator",
        "circle",
        "type",
        "status",
        "recharged_at",
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'recharged_at' => 'datetime',
        ];
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
