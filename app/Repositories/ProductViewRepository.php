<?php

namespace App\Repositories;

use App\Models\ProductView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProductViewRepository
 * @package App\Repositories
 * @version December 28, 2018, 4:15 pm UTC
 *
 * @method ProductView findWithoutFail($id, $columns = ['*'])
 * @method ProductView find($id, $columns = ['*'])
 * @method ProductView first($columns = ['*'])
*/
class ProductViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'product_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProductView::class;
    }
}
