<?php

namespace App\Repositories\Admin;

use App\Models\PostCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostCategoryRepository
 * @package App\Repositories\Admin
 * @version August 27, 2019, 1:52 pm -05
 *
 * @method PostCategory findWithoutFail($id, $columns = ['*'])
 * @method PostCategory find($id, $columns = ['*'])
 * @method PostCategory first($columns = ['*'])
*/
class PostCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostCategory::class;
    }
}
