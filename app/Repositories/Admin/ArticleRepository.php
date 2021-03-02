<?php

namespace App\Repositories\Admin;

use App\Models\Article;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ArticleRepository
 * @package App\Repositories\Admin
 * @version April 4, 2019, 10:10 pm UTC
 *
 * @method Article findWithoutFail($id, $columns = ['*'])
 * @method Article find($id, $columns = ['*'])
 * @method Article first($columns = ['*'])
*/
class ArticleRepository extends BaseRepository
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
        return Article::class;
    }
}
