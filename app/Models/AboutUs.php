<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'achievements_one_title',
        'achievements_one_description',
        'achievements_one_icon',
        'achievements_one_count',
        'achievements_two_title',
        'achievements_two_description',
        'achievements_two_icon',
        'achievements_two_count',
        'achievements_three_title',
        'achievements_three_description',
        'achievements_three_icon',
        'achievements_three_count',
    ];

    public function getAchievementsOneIconAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/45";
    }

    public function getAchievementsTwoIconAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/45";
    }

    public function getAchievementsThreeIconAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/45";
    }

    public function getImageAttribute($value)
    {
        return $value ? asset($value) : "https://placehold.co/656x545";
    }

}
