<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NsdlUserSetting extends Model
{
    protected $fillable = [
        "user_id",
        "agent_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
