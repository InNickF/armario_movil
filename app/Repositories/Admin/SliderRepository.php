<?php

namespace App\Repositories\Admin;

use App\Models\Slider;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SliderRepository
 * @package App\Repositories\Admin
 * @version September 27, 2019, 5:32 pm -05
 *
 * @method Slider findWithoutFail($id, $columns = ['*'])
 * @method Slider find($id, $columns = ['*'])
 * @method Slider first($columns = ['*'])
*/
class SliderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'position',
        'type',
        'height',
        'width',
        'category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Slider::class;
    }
}
