<?php

namespace App\Repositories\Admin;

use App\Models\StaticBanner;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StaticBannerRepository
 * @package App\Repositories\Admin
 * @version March 13, 2019, 9:29 pm UTC
 *
 * @method StaticBanner findWithoutFail($id, $columns = ['*'])
 * @method StaticBanner find($id, $columns = ['*'])
 * @method StaticBanner first($columns = ['*'])
*/
class StaticBannerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'name',
        'description',
        'location',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StaticBanner::class;
    }
}
