<?php

namespace App\Repositories\Admin;

use App\Models\Review;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ReviewRepository
 * @package App\Repositories\Admin
 * @version February 27, 2019, 1:40 pm UTC
 *
 * @method Review findWithoutFail($id, $columns = ['*'])
 * @method Review find($id, $columns = ['*'])
 * @method Review first($columns = ['*'])
*/
class ReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'body',
        'rating',
        'user_id',
        'product_id',
        'store_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Review::class;
    }
}
