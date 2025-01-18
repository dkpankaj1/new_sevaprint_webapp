<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Feature extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        "code",
        "name",
        "description",
        "fee",
        "enable",
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Contain, 200, 113)
            ->nonQueued();
    }
}
