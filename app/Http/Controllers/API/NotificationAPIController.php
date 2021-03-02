<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;

class NotificationAPIController extends \App\Http\Controllers\Controller
{



    public function index(Request $request)
    {
        $notifications = Auth::user()->notifications()->paginate(5);
        $total = auth()->user()->unreadNotifications->count();
        return $this->sendResponse(compact('notifications', 'total'), 'Notificaciones obtenidas');
    }

    public function markAsRead($id, Request $request)
    {
        $notification = auth('api')->user()->notifications()->where('id', $id)->first();

        if(!$notification) {
            return $this->sendError('Notificación no encontrada');
        }

        $notification->markAsRead();
        $total = auth()->user()->unreadNotifications->count();

        return $this->sendResponse(compact('notification', 'total'), 'Notificación leída');
    }

}
