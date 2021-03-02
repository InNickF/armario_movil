<?php

namespace App\Repositories;

use App\Models\Review;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ReviewRepository
 * @package App\Repositories
 * @version March 7, 2019, 5:31 pm UTC
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
