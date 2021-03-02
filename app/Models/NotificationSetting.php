<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="NotificationSetting",
 *      required={"user_id", "notification_type_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="notification_type_id",
 *          description="notification_type_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="send_email",
 *          description="send_email",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="send_push",
 *          description="send_push",
 *          type="boolean"
 *      )
 * )
 */
class NotificationSetting extends Model
{

    public $table = 'notification_settings';
    


    public $fillable = [
        'user_id',
        'notification_type_id',
        'send_email',
        'send_push'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'notification_type_id' => 'integer',
        'send_email' => 'boolean',
        'send_push' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'notification_type_id' => 'required'
    ];

    
}
