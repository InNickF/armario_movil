<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Tax",
 *      required={"name", "percentage"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="percentage",
 *          description="percentage",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="is_active",
 *          description="is_active",
 *          type="boolean"
 *      )
 * )
 */
class Tax extends Model
{

    public $table = 'taxes';
    


    public $fillable = [
        'name',
        'description',
        'percentage',
        'is_active'
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
        'percentage' => 'float',
        'is_active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'percentage' => 'required'
    ];

    
}
