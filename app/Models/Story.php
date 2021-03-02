<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Story.
 *
 * @version August 8, 2019, 10:31 am -05
 *
 * @property \App\Models\ store
 * @property string title
 * @property string body
 * @property string url
 */
class Story extends Model implements HasMedia
{
    use HasMediaTrait;

    public $table = 'stories';

    public $fillable = [
        'title',
        'body',
        'url',
        'store_id',
        'admin_comment',
        'is_active',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        // 'title' => 'required',
        'url' => 'required',
    ];

    public $appends = [
        'image',
        'expires_at',
    ];

    public $with = [
        'store',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'title' => 'string',
        'body' => 'string',
        'url' => 'string',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(400)
            ->sharpen(10)
        ;

        $this->addMediaConversion('medium')
            ->width(772)
            ->sharpen(2)
        ;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(\App\Models\UserStore::class);
    }

    // public function all_media()
    // {
    //     return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    // }

    public function saveImage($path)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['isMain' => true])
            ->toMediaCollection('stories')
        ;
    }

    public function getImageAttribute()
    {
        $images = $this->media;
        $default = null;

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isMain')) {
                // if video show original
                if (false === strpos($image->mime_type, 'video')) {
                    return $image->getFullUrl('medium');
                }

                return $image->getFullUrl();
            }
        }

        return $default;
    }

    public function getImageThumbnailAttribute()
    {
        $images = $this->media;
        $default = null;

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isMain')) {
                return $image->getFullUrl('thumb');
            }
        }

        return $default;
    }

    public function scopeIsActive(Builder $builder): Builder
    {
        $dayAgo = Carbon::now()->subHours(24);

        return $builder->where('created_at', '>=', $dayAgo)->where('is_active', true);
    }

    public function getExpirationDate()
    {
        return $this->created_at->addHours(24);
    }

    public function getExpiresAtAttribute()
    {
        return $this->getExpirationDate()->format('Y/m/d H:i');
    }

    public function isExpired()
    {
        return $this->getExpirationDate() <= Carbon::now();
    }

    public function getStatus()
    {
        if ($this->isExpired()) {
            return 'Expirado';
        }

        if (!$this->is_active) {
            return 'Inactivo/Pendiente';
        }

        return 'Activo';
    }
}