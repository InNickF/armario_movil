<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Image",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="entity_id",
 *          description="entity_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="entity_type",
 *          description="entity_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="path",
 *          description="path",
 *          type="string"
 *      )
 * )
 */
class Image extends Model
{

    public $table = 'images';
    


    public $fillable = [
        'path'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'entity_id' => 'integer',
        'entity_type' => 'string',
        'path' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
