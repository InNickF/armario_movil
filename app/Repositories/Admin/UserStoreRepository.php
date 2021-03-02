<?php

namespace App\Repositories\Admin;

use App\Models\UserStore;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserStoreRepository
 * @package App\Repositories\Admin
 * @version July 3, 2019, 8:41 am -05
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
        'name',
        'description',
        'email',
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
