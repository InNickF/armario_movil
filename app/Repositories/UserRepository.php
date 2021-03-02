<?php

namespace App\Repositories;

use App\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version December 17, 2018, 2:38 pm UTC
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
        'password',
        'phone',
        'address',
        'description',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'website',
        'language',
        'store_id',
        'email_verified_at',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
