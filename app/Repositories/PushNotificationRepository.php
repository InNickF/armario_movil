<?php

namespace App\Repositories;

use App\Models\PushNotification;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NotificationRepository
 * @package App\Repositories
 * @version December 5, 2018, 3:16 pm UTC
 *
 * @method Notification findWithoutFail($id, $columns = ['*'])
 * @method Notification find($id, $columns = ['*'])
 * @method Notification first($columns = ['*'])
*/
class PushNotificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'success',
        'response'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PushNotification::class;
    }
}
