<?php

namespace App\Repositories;

use App\Models\Category;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version February 27, 2019, 4:46 pm UTC
 *
 * @method Category findWithoutFail($id, $columns = ['*'])
 * @method Category find($id, $columns = ['*'])
 * @method Category first($columns = ['*'])
*/
class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
        'description',
        'is_active',
        'parent_id',
        'order'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category::class;
    }
}
