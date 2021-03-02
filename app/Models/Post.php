<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasSlug;
    public $table = 'posts';

    public $fillable = [
        'title',
        'slug',
        'body',
        'description',
        'user_id',
    ];

    public $appends = [
        'main_image',
        'url',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'body' => 'required',
        'description' => 'required',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'body' => 'string',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(320)
            ->sharpen(10)
        ;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
        ;
    }

    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'posts_post_categories', 'post_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function getAllMediaAttribute()
    {
        return $this->media;
    }

    public function getMainImageAttribute()
    {
        $images = $this->media;
        $default = null;

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isMain')) {
                return $image->getFullUrl();
            }
        }

        return $default;
    }

    public function getUrlAttribute()
    {
        // if (!$this->store) {
        //     return url('/');
        // }
        $slug = $this->slug;

        return url('blog/'.$slug);
    }

    public function saveMainImage($path)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['isMain' => true])
            ->toMediaCollection('posts')
        ;
    }
}