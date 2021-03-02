<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewAnswer extends Model
{   
    public $fillable = [
        'body',
        'review_id',
        'user_id'
    ];

    public static $rules = [
        'body' => 'required'
    ];

    public function review() {
        return $this->belongsTo(\App\Models\Review::class);
    }
}
