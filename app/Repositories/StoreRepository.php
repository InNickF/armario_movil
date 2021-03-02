<?php

namespace App\Repositories;

use App\Models\Store;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StoreRepository
 * @package App\Repositories
 * @version December 26, 2018, 5:35 pm UTC
 *
 * @method Store findWithoutFail($id, $columns = ['*'])
 * @method Store find($id, $columns = ['*'])
 * @method Store first($columns = ['*'])
*/
class StoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'email',
        'logo_image',
        'latitude',
        'longitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Store::class;
    }
}
