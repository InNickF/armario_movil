<?php

namespace App\Repositories\Admin;

use App\Models\FaqCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FaqCategoryRepository
 * @package App\Repositories\Admin
 * @version March 6, 2019, 7:54 pm UTC
 *
 * @method FaqCategory findWithoutFail($id, $columns = ['*'])
 * @method FaqCategory find($id, $columns = ['*'])
 * @method FaqCategory first($columns = ['*'])
*/
class FaqCategoryRepository extends BaseRepository
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
        return FaqCategory::class;
    }
}
