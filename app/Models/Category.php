<?php

namespace App\Models;

use Eloquent as Model;
use Nestable\NestableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

class Category extends Model implements HasMedia
{
    use NestableTrait;
    use HasMediaTrait;
    use CanBeFollowed;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public $table = 'categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'parent_id',
        'order',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
        'parent_id' => 'integer',
        'order' => 'integer',
    ];

    public $appends = [
        'icon_image',
        'icon_image_jpg',
        'url',
        'name_with_parent'
    ];

    public static $rules = [
        'name' => 'required',
        'order' => 'required|unique',
    ];

    public $with = [
        'all_media',
    ];

    public function main_products()
    {
        return $this->hasMany(\App\Models\Product::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }

    public function all_media()
    {
        return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    }

    public function getAllMedia()
    {
        return $this->all_media;
    }



    public function saveIconImage($path)
    {
        $this->addMedia(public_path('storage/' . $path))
            ->withCustomProperties(['isMain' => true])
            ->toMediaCollection('categories');
    }


    public function saveIconImageJpg($path)
    {
        $this->addMedia(public_path('storage/' . $path))
            ->withCustomProperties(['isJpg' => true])
            ->toMediaCollection('categories');
    }

    public function getIconImageAttribute()
    {
        $images = $this->getAllMedia();
        $default = 'https://placehold.it/40x40';

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

    public function getIconImageJpgAttribute()
    {
        $images = $this->getAllMedia();
        $default = 'https://placehold.it/40x40';

        if (!$images || empty($images)) {
            return $default;
        }

        foreach ($images as $key => $image) {
            if ($image->hasCustomProperty('isJpg')) {
                return $image->getFullUrl();
            }
        }

        return $default;
    }

    public function scopeParents($query)
    {
        return $query->where('parent_id', null);
    }

    public function scopeChildrens($query)
    {
        return $query->where('parent_id', '!=', null);
    }

    public function getUrlAttribute()
    {

        // if (!$this->store) {
        //     return url('/');
        // }
        $slug = $this->slug;
        return url('/categorias/' . $slug);
    }


    public function getNameWithParentAttribute()
    {
        return ($this->parent ? $this->parent->name . ': ' : '') . $this->name;
    }
}