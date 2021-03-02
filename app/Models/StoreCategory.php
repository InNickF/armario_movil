<?php

namespace App\Models;

use Eloquent as Model;
use Nestable\NestableTrait;
use Spatie\Translatable\HasTranslations;

/**
 * @SWG\Definition(
 *      definition="StoreCategory",
 *      required={"name", "slug", "description"},
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
 *          property="slug",
 *          description="slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="parent_id",
 *          description="parent_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class StoreCategory extends Model
{
    use NestableTrait;
    protected $parent = 'parent_id';

    use HasTranslations;
    public $translatable = ['name', 'description'];
    
    public $table = 'store_categories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'parent_id' => 'integer',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'image' => 'required_without:id',
        // 'description' => 'required'
    ];

    
}
