<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class FormRequest
 * @package App\Models
 * @version May 17, 2019, 4:56 pm -05
 *
 * @property string email
 */
class FormRequest extends Model
{

    public $table = 'form_requests';



    public $fillable = [
        'first_name',
        'last_name',
        'subject',
        'message',
        'email',
        'phone',
        'origin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required|email'
    ];


}
