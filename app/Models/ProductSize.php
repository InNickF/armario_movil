<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProductSize
 * @package App\Models
 * @version July 3, 2019, 1:01 pm -05
 *
 * @property string name
 */
class ProductSize extends Model
{

    public $table = 'product_sizes';
    


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];


    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'categories_product_sizes');
    }

    
}
