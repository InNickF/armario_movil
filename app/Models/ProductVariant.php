<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ProductVariant extends Model implements HasMedia
{
    use HasMediaTrait;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($variant) {
            $variant->uuid = (string) Str::uuid();
        });
    }


    public $table = 'product_variants';



    public $fillable = [
        'product_id',
        'color',
        'size',
        'quantity',
        'uuid',
        'sku'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'color' => 'string',
        'size' => 'string',
        'quantity' => 'integer',
        'uuid' => 'string',
        'sku' => 'string',
    ];


    public $appends = [
        'media'
    ];

    public $with = [
        'all_media',
        // 'product'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required',
        'color' => 'required',
        'size' => 'required',
        'quantity' => 'required',
    ];


    public function all_media()
    {
        return $this->morphMany('Spatie\MediaLibrary\Models\Media', 'model');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class)->withTrashed();
    }


    public function ordered_items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function saveVariantImage($key, $path) // key = 'image_X'
    {
        $this->addMedia(public_path('storage/' . $path))
            ->withCustomProperties(['variantId' => $this->id, 'key' => $key])
            ->toMediaCollection('products');
    }


    public function getAllMedia()
    {
        return $this->all_media;
    }

    public function getAllImages()
    {
        $images = $this->getAllMedia();

        foreach ($images as $key => &$media) {
            if (strpos($media->mime_type, 'video') !== false) {
                unset($images[$key]);
            }
        }
        return $images;
    }


    public function getMediaAttribute()
    {
        $images = $this->all_media;

        $final = null;

        if ($images && $images->count()) {
            foreach ($images as $key => $image) {
                $final[$image->getCustomProperty('key')] = $image->getFullUrl();
            }
        }

        return $final;
    }





    public function reduceStock($qty)
    {
        if ($this->quantity <= 0) {
            return;
        }

        if ($qty >= $this->quantity) {
            $this->quantity = 0;
            $this->save();
            return;
        }

        $this->quantity = $this->quantity - $qty;
        $this->save();
    }

    public function returnStock($qty)
    {
        if ($this->quantity <= 0) {
            return;
        }

        $this->quantity = $this->quantity + $qty;
        $this->save();
    }
}