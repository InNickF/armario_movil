<?php

namespace App\Repositories\Admin;

use App\Models\Post;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostRepository
 * @package App\Repositories\Admin
 * @version August 27, 2019, 1:51 pm -05
 *
 * @method Post findWithoutFail($id, $columns = ['*'])
 * @method Post find($id, $columns = ['*'])
 * @method Post first($columns = ['*'])
*/
class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }
}
