<?php

namespace App\Repositories;

use App\Models\Coupon;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CouponRepository
 * @package App\Repositories
 * @version February 15, 2019, 5:25 pm UTC
 *
 * @method Coupon findWithoutFail($id, $columns = ['*'])
 * @method Coupon find($id, $columns = ['*'])
 * @method Coupon first($columns = ['*'])
*/
class CouponRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'type',
        'discount',
        'available_uses',
        'uses_count'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coupon::class;
    }
}
