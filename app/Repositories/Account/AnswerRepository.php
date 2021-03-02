<?php

namespace App\Repositories\Account;

use App\Models\Answer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AnswerRepository
 * @package App\Repositories\Account
 * @version February 28, 2019, 9:14 pm UTC
 *
 * @method Answer findWithoutFail($id, $columns = ['*'])
 * @method Answer find($id, $columns = ['*'])
 * @method Answer first($columns = ['*'])
*/
class AnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'body',
        'question_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Answer::class;
    }
}
