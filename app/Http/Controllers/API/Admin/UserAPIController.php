<?php

namespace App\Http\Controllers\API\Admin;

use App\User;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends \App\Http\Controllers\Controller
{
    public function changePlan($id)
    {
        $input = request()->all();
        $user = User::find($id);
        $plan = app('rinvex.subscriptions.plan')->find($input['planId']);

        if (empty($plan)) {
            return $this->sendError('Plan no encontrado');
        }

        if (empty($user)) {
            return $this->sendError('Usuario no encontrado');
        }

        if (!$user->subscribedTo($plan)) {
            $user->getSubscription()->changePlan($plan);
        }

        return $this->sendResponse($plan->toArray(), 'User plan changed successfully');
    }
}
