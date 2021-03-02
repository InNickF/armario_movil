<?php

namespace App\Repositories;

use App\Models\Outfit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OutfitRepository
 * @package App\Repositories
 * @version June 12, 2019, 9:58 am -05
 *
 * @method Outfit findWithoutFail($id, $columns = ['*'])
 * @method Outfit find($id, $columns = ['*'])
 * @method Outfit first($columns = ['*'])
*/
class OutfitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'store_id',
        'name',
        'slug',
        'description',
        'is_active',
        'category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Outfit::class;
    }
}
