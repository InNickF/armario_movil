<?php

namespace App\Repositories\Admin;

use App\Models\Order;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories\Admin
 * @version March 19, 2019, 4:27 pm UTC
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
