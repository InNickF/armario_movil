<?php

namespace App\Repositories\Admin;

use App\Models\ArticleCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ArticleCategoryRepository
 * @package App\Repositories\Admin
 * @version April 4, 2019, 10:14 pm UTC
 *
 * @method ArticleCategory findWithoutFail($id, $columns = ['*'])
 * @method ArticleCategory find($id, $columns = ['*'])
 * @method ArticleCategory first($columns = ['*'])
*/
class ArticleCategoryRepository extends BaseRepository
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
        return ArticleCategory::class;
    }
}
