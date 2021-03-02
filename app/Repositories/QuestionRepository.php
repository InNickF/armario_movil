<?php

namespace App\Repositories;

use App\Models\Question;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionRepository
 * @package App\Repositories
 * @version February 28, 2019, 7:43 pm UTC
 *
 * @method Question findWithoutFail($id, $columns = ['*'])
 * @method Question find($id, $columns = ['*'])
 * @method Question first($columns = ['*'])
*/
class QuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'body',
        'user_id',
        'product_id',
        'store_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Question::class;
    }
}
