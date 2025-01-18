<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getAvatarAttribute($value)
    {
        return $value ? asset($value) : 'https://placehold.co/128x128';
    }
}
