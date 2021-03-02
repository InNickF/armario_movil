<?php

namespace App\Models;

use Eloquent as Model;


class PushNotification extends Model
{

    public $table = 'push_notifications';
    


    public $fillable = [
        'title',
        'body',
        'success',
        'response'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'body' => 'string',
        'success' => 'integer',
        'response' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'body' => 'required',
    ];

}
