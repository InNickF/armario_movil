<?php

namespace App\Repositories\Admin;

use App\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository.
 *
 * @version February 4, 2019, 6:37 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'store_id',
    ];

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return User::class;
    }
}
