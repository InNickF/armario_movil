<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Setting
 * @package App\Models
 * @version March 27, 2019, 9:35 pm UTC
 *
 * @property string key
 * @property json value
 */
class Setting extends Model
{

    public $table = 'settings';
    


    public $fillable = [
        'key',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'value' => 'required'
    ];

    
}
