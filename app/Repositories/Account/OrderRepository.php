<?php

namespace App\Repositories\Account;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories\Account
 * @version March 19, 2019, 7:28 pm UTC
 *
 * @method Order findWithoutFail($id, $columns = ['*'])
 * @method Order find($id, $columns = ['*'])
 * @method Order first($columns = ['*'])
*/
class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status_id',
        'user_id',
        'shipping_address_id',
        'billing_address_id',
        'total_price',
        'notes',
        'coupon_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }
}
