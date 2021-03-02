<?php

namespace App\Repositories\Admin;

use App\Models\Slide;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SlideRepository
 * @package App\Repositories\Admin
 * @version September 29, 2019, 8:49 am -05
 *
 * @method Slide findWithoutFail($id, $columns = ['*'])
 * @method Slide find($id, $columns = ['*'])
 * @method Slide first($columns = ['*'])
*/
class SlideRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'body',
        'url',
        'button_text',
        'button_theme',
        'order'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Slide::class;
    }
}
