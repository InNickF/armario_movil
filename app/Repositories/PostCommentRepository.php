<?php

namespace App\Repositories;

use App\Models\PostComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostCommentRepository
 * @package App\Repositories
 * @version August 27, 2019, 1:51 pm -05
 *
 * @method PostComment findWithoutFail($id, $columns = ['*'])
 * @method PostComment find($id, $columns = ['*'])
 * @method PostComment first($columns = ['*'])
*/
class PostCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'post_id',
        'user_id',
        'body'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PostComment::class;
    }
}
