<?php

namespace App\Models;

use Eloquent as Model;



class OrderStatus extends Model
{

    public $table = 'order_statuses';
    


    public $fillable = [
        'name',
        'slug',
        'description',
        'send_email',
        'email_template',
        'color'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'send_email' => 'boolean',
        'email_template' => 'string',
        'slug' => 'string',
        'color' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'color' => 'required'
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    
}
