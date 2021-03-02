<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductRepository
 * @package App\Repositories\Admin
 * @version February 19, 2019, 4:14 pm UTC
 *
 * @method Product findWithoutFail($id, $columns = ['*'])
 * @method Product find($id, $columns = ['*'])
 * @method Product first($columns = ['*'])
*/
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'name',
        'slug',
        'description',
        'is_active',
        'has_discount',
        'quantity',
        'price',
        'category_id',
        'package_width',
        'package_height',
        'package_depth',
        'package_weight',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
