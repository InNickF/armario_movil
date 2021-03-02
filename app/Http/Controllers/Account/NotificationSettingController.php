<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\CreateNotificationSettingRequest;
use App\Http\Requests\UpdateNotificationSettingRequest;
use App\Repositories\NotificationSettingRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\NotificationType;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;

class NotificationSettingController extends \App\Http\Controllers\Controller
{
    /** @var NotificationSettingRepository */
    private $notificationSettingRepository;

    public function __construct(NotificationSettingRepository $notificationSettingRepo)
    {
        $this->notificationSettingRepository = $notificationSettingRepo;
    }

    public function index(Request $request)
    {
        $this->notificationSettingRepository->pushCriteria(new RequestCriteria($request));
        $notificationSettings = $this->notificationSettingRepository->findWhere([
            'user_id' => Auth::user()->id,
        ]);

        $notificationTypes = NotificationType::all();

        return view('account.notification_settings.index')
            ->with('notificationSettings', $notificationSettings)
            ->with('notificationTypes', $notificationTypes);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $input = $request->all();
        $notificationTypes = NotificationType::all();

        foreach ($notificationTypes as $key => $type) {
            if(isset($input['settings'][$type->id]) && !empty($input['settings'][$type->id])) {
                $value = $input['settings'][$type->id];
                $setting = auth()->user()->getNotificationSetting($type->id);
                // dd($value);
                $setting->send_push = $value['send_push'] ?? false;
                $setting->send_email = $value['send_email'] ?? false;
                $setting->save();
            }
        }

        alert()->success('Ajustes actualizados');

        return redirect(route('account.notificationSettings'));
    }

}
