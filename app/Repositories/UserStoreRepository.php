<?php

namespace App\Repositories;

use App\Models\UserStore;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserStoreRepository
 * @package App\Repositories
 * @version April 4, 2019, 8:17 pm UTC
 *
 * @method UserStore findWithoutFail($id, $columns = ['*'])
 * @method UserStore find($id, $columns = ['*'])
 * @method UserStore first($columns = ['*'])
*/
class UserStoreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'description',
        'email',
        'logo_image',
        'address',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserStore::class;
    }
}
