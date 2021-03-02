<?php

namespace App\Models;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Bank extends Model implements HasMedia
{
    use HasMediaTrait;

    public $appends = [
        'logo'
    ];


    public function getAllMedia()
    {
        return Media::whereModelType('App\Models\Bank')->whereModelId($this->id)->get();
    }


    public function getLogoAttribute()
    {
        $images = $this->getAllMedia();
        $default = null;

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isLogo')) {
                return $image->getFullUrl();
            }
        }

        return $default;
    }
}
