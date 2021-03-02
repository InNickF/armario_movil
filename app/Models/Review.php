<?php

namespace App\Models;

use Eloquent as Model;

class Review extends Model
{

    public $table = 'reviews';



    public $fillable = [
        'body',
        'rating',
        'user_id',
        'reviewable_id',
        'reviewable_type'
    ];


    protected $casts = [
        'id' => 'integer',
        'body' => 'string',
        'rating' => 'integer',
        'user_id' => 'integer',
        'reviewable_type' => 'string',
        'reviewable_id' => 'integer',
    ];


    public static $rules = [
        'rating' => 'required',
    ];


    public function reviewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function answer()
    {
        return $this->hasOne(\App\Models\ReviewAnswer::class);
    }


    public function scopeStoreId($query, $storeId)
    {
        return $query->orWhereHasMorph(
            'reviewable',
            ['App\Models\OrderItem'],
            function ($morphQuery) use ($storeId) {
                $morphQuery->whereHas('product_variant.product.store', function($store) use($storeId) {
                    $store->where('id', $storeId);
                });
            }
        );
    }
}
