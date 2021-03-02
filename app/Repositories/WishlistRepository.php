<?php

namespace App\Repositories;

use App\Models\Wishlist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class WishlistRepository
 * @package App\Repositories
 * @version December 27, 2018, 3:27 pm UTC
 *
 * @method Wishlist findWithoutFail($id, $columns = ['*'])
 * @method Wishlist find($id, $columns = ['*'])
 * @method Wishlist first($columns = ['*'])
*/
class WishlistRepository extends BaseRepository
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
        return Wishlist::class;
    }
}
