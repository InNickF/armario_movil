<?php

namespace App\Http\Requests;

use App\Models\Notification;
use App\Models\PushNotification;
use Illuminate\Foundation\Http\FormRequest;

class CreateNotificationRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return PushNotification::$rules;
    }
}
