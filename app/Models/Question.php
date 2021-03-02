<?php

namespace App\Models;

use Eloquent as Model;

class Question extends Model
{

    public $table = 'questions';



    public $fillable = [
        'body',
        'user_id',
        'product_id',
        'store_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'body' => 'string',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'store_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'body' => 'required',
        'product_id' => 'required|exists:products,id',
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class)->withTrashed();
    }

    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class);
    }
}