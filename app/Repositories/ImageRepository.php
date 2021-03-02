<?php

namespace App\Repositories;

use App\Models\Image;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImageRepository
 * @package App\Repositories
 * @version December 5, 2018, 5:10 pm UTC
 *
 * @method Image findWithoutFail($id, $columns = ['*'])
 * @method Image find($id, $columns = ['*'])
 * @method Image first($columns = ['*'])
*/
class ImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'path'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Image::class;
    }
}
