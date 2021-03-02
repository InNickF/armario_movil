<?php

namespace App\Repositories\Admin;

use App\Models\Faq;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FaqRepository
 * @package App\Repositories
 * @version March 6, 2019, 7:52 pm UTC
 *
 * @method Faq findWithoutFail($id, $columns = ['*'])
 * @method Faq find($id, $columns = ['*'])
 * @method Faq first($columns = ['*'])
*/
class FaqRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Faq::class;
    }
}
