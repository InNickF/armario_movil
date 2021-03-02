<?php

namespace App\Repositories;

use App\Models\Address;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version March 18, 2019, 4:23 pm UTC
 *
 * @method Address findWithoutFail($id, $columns = ['*'])
 * @method Address find($id, $columns = ['*'])
 * @method Address first($columns = ['*'])
*/
class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'addressable_type',
        'addressable_id',
        'given_name',
        'family_name',
        'label',
        'organization',
        'country_code',
        'street',
        'state',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'is_primary',
        'is_billing',
        'is_shipping',
        'phone',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Address::class;
    }
}
