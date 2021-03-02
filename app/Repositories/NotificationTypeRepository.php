<?php

namespace App\Repositories;

use App\Models\NotificationType;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NotificationTypeRepository
 * @package App\Repositories
 * @version February 11, 2019, 10:13 pm UTC
 *
 * @method NotificationType findWithoutFail($id, $columns = ['*'])
 * @method NotificationType find($id, $columns = ['*'])
 * @method NotificationType first($columns = ['*'])
*/
class NotificationTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'icon'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NotificationType::class;
    }
}
