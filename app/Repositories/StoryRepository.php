<?php

namespace App\Repositories;

use App\Models\Story;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StoryRepository
 * @package App\Repositories
 * @version August 8, 2019, 10:35 am -05
 *
 * @method Story findWithoutFail($id, $columns = ['*'])
 * @method Story find($id, $columns = ['*'])
 * @method Story first($columns = ['*'])
*/
class StoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Story::class;
    }
}
