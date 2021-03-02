<?php

namespace App\Repositories\Account;

use App\Models\Question;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionRepository
 * @package App\Repositories\Account
 * @version February 28, 2019, 8:07 pm UTC
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
