<?php

namespace App\Repositories\Admin;

use App\Models\FormRequest;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FormRequestRepository
 * @package App\Repositories\Admin
 * @version May 17, 2019, 6:33 pm -05
 *
 * @method FormRequest findWithoutFail($id, $columns = ['*'])
 * @method FormRequest find($id, $columns = ['*'])
 * @method FormRequest first($columns = ['*'])
*/
class FormRequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'first_name',
        'last_name',
        'subject',
        'message'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return FormRequest::class;
    }
}
