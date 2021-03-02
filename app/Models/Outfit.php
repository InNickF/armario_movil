<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use stdClass;

class Outfit extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasSlug;
    use SoftDeletes;

    public $table = 'outfits';

    public $with = [
        'products',
        'all_media',
    ];

    public $fillable = [
        'store_id',
        'name',
        'slug',
        'description',
        'is_active',
        'category_id',
        'features',
    ];

    public static $rules = [
        'store_id' => 'required',
        'name' => 'required',
        'description' => 'required',
        'features' => 'required',
    ];

    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
        'features' => 'array',
    ];

    protected $appends = [
        'url',
        'price',
        'is_favorited',
        'main_image',
        'main_image_thumbnail',
        'media',
        'categories',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->sharpen(10)
        ;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
        ;
    }

    public function store()
    {
        return $this->belongsTo(\App\Models\UserStore::class);
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class, 'outfits_products')->withPivot('order');
    }

    public function getCategoriesAttribute()
    {
        return $this->products->pluck('category');
    }

    public function all_media()
    {
        return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    }

    public function getUrlAttribute()
    {
        // if (!$this->store) {
        //     return url('/');
        // }
        $storeSlug = $this->store ? $this->store->slug : 'sin-tienda';
        $outfitSlug = $this->slug;

        return url('/outfits/'.$storeSlug.'/'.$outfitSlug, ['']);
    }

    public function getPriceAttribute()
    {
        return $this->products->sum('final_price');
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function isFavorited()
    {
        $products = $this->products;

        foreach ($products as $key => $product) {
            if (auth()->check()) {
                if (!$product->isFavoritedBy(auth()->user())) {
                    return false;
                }
            } elseif (auth('api')->check()) {
                if (!$product->isFavoritedBy(auth('api')->user())) {
                    return false;
                }
            } else {
                return false;
            }
        }

        return true;
    }

    public function getAllMedia()
    {
        return $this->all_media;
    }

    public function getAllImages()
    {
        // $images = $this->getMedia();
        // dd($images);
        $images = $this->all_media;

        foreach ($images as $key => &$media) {
            if (false !== strpos($media->mime_type, 'video')) {
                unset($images[$key]);
            }
        }

        return $images;
    }

    public function getMainImageAttribute()
    {
        $images = $this->getAllImages();
        $default = null;

        if (!$images || !$images->count()) {
            return $default;
        }

        // dd($images->first()->getFullUrl());
        // foreach ($image as $key => $image) {
        //     if ($image->hasCustomProperty('isMain')) {
        return $images->first()->getFullUrl();
        //     }
        // }
    }

    public function getMainImageThumbnailAttribute()
    {
        $images = $this->getAllImages();
        $default = null;
        if (!$images || !$images->count()) {
            return $default;
        }

        return $images->first()->getFullUrl('thumb');
    }

    // public function getHasStockAttribute()
    // {
    //     return $this->hasStock();
    // }

    // public function hasStock()
    // {
    //     return $this->products()->hasStock()->count();
    // }

    public function scopeHasStock($query)
    {
        return $query->with('products')->whereHas('products', function ($prod) {
            $prod->hasStock();
        });
    }

    public function getMediaAttribute()
    {
        $result = new stdClass();
        $images = $this->all_media;

        foreach ($images as $key => $image) {
            if ($image->getCustomProperty('key')) {
                $key = $image->getCustomProperty('key');
                $result->{$key} = $image->getFullUrl();
            }
        }

        return $result;
    }

    public function saveImage($key, $path)
    {
        $this->addMedia(public_path('storage/'.$path))
            ->withCustomProperties(['key' => $key])
            ->toMediaCollection('outfits')
        ;
    }
}