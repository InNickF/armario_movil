<?php

namespace App\Repositories;

use App\Models\Banner;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class BannerRepository
 * @package App\Repositories
 * @version December 26, 2018, 5:35 pm UTC
 *
 * @method Banner findWithoutFail($id, $columns = ['*'])
 * @method Banner find($id, $columns = ['*'])
 * @method Banner first($columns = ['*'])
*/
class BannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'store_id',
        'image',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Banner::class;
    }
}
