<?php

namespace App\Repositories\Admin;

use App\Models\Testimonial;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TestimonialRepository
 * @package App\Repositories\Admin
 * @version March 6, 2019, 8:38 pm UTC
 *
 * @method Testimonial findWithoutFail($id, $columns = ['*'])
 * @method Testimonial find($id, $columns = ['*'])
 * @method Testimonial first($columns = ['*'])
*/
class TestimonialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rating',
        'body',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Testimonial::class;
    }
}
