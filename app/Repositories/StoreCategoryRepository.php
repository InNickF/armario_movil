<?php

namespace App\Repositories;

use App\Models\StoreCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StoreCategoryRepository
 * @package App\Repositories
 * @version December 28, 2018, 12:58 pm UTC
 *
 * @method StoreCategory findWithoutFail($id, $columns = ['*'])
 * @method StoreCategory find($id, $columns = ['*'])
 * @method StoreCategory first($columns = ['*'])
*/
class StoreCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'image'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StoreCategory::class;
    }
}
