<?php

namespace App\Repositories;

use App\Models\NotificationSetting;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NotificationSettingRepository
 * @package App\Repositories
 * @version February 11, 2019, 10:23 pm UTC
 *
 * @method NotificationSetting findWithoutFail($id, $columns = ['*'])
 * @method NotificationSetting find($id, $columns = ['*'])
 * @method NotificationSetting first($columns = ['*'])
*/
class NotificationSettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'notification_type_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NotificationSetting::class;
    }
}
