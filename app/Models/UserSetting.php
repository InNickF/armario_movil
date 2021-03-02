<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class UserSetting
 * @package App\Models
 * @version April 18, 2019, 4:30 pm UTC
 *
 * @property string key
 * @property json value
 */
class UserSetting extends Model
{

    public $table = 'user_settings';
    


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
        'user_id' => 'integer',
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
