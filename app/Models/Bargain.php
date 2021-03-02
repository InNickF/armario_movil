<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Bargain
 * @package App\Models
 * @version July 2, 2019, 2:49 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer product_id
 * @property string status
 */
class Bargain extends Model
{

    public $table = 'bargains';
    


    public $fillable = [
        'product_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'product_id' => 'required'
    ];

    
}
