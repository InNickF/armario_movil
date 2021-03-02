<?php

namespace App\Http\Controllers\Admin;

use FCM;
use Flash;
use App\User;
use Response;
use Illuminate\Support\Facades\Auth;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PushNotificationRepository;
use App\DataTables\Admin\PushNotificationDataTable;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use LaravelFCM\Message\PayloadNotificationBuilder;

class PushNotificationController extends \App\Http\Controllers\Controller
{
    /** @var PushNotificationRepository */
    private $notificationRepository;

    public function __construct(PushNotificationRepository $notificationRepo)
    {
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Notification.
     *
     * @param PushNotificationDataTable $notificationDataTable
     *
     * @return Response
     */
    public function index(PushNotificationDataTable $notificationDataTable)
    {
        if (Auth::user()->isNotA('super-user')) {
            abort(403);
        }

        return $notificationDataTable->render('admin.push_notifications.index');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.push_notifications.create');
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $input = $request->all();

        $notification = $this->notificationRepository->create($input);

        alert()->success('Notification saved successfully.');

        return redirect(route('admin.push_notifications.index'));
    }

    public function send($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            alert()->error('Notification no encontrad@');

            return redirect(route('admin.push_notifications.index'));
        }

        try {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);

            $notificationBuilder = new PayloadNotificationBuilder($notification->title);
            $notificationBuilder->setBody($notification->body)
                        ->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            // You must change it to get your tokens
            $tokens = User::pluck('fcm_token')->toArray();

            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

            $notification->response = json_encode($downstreamResponse);
            $notification->success = true;

            $notification = $this->notificationRepository->update($notification->toArray(), $id);

            // $downstreamResponse->numberSuccess();
            // $downstreamResponse->numberFailure();
            // $downstreamResponse->numberModification();

            // //return Array - you must remove all this tokens in your database
            // $downstreamResponse->tokensToDelete();

            // //return Array (key : oldToken, value : new token - you must change the token in your database )
            // $downstreamResponse->tokensToModify();

            // //return Array - you should try to resend the message to the tokens in the array
            // $downstreamResponse->tokensToRetry();

            // // return Array (key:token, value:errror) - in production you should remove from your database the tokens present in this array
            // $downstreamResponse->tokensWithError();
            alert()->success('Notifications sent successfully.');
        } catch (\Throwable $th) {
            alert()->error('Error sending notification: '.$th);

            return back();
        }

        return back();
    }

    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            alert()->error('Notification no encontrad@');

            return redirect(route('admin.push_notifications.index'));
        }

        return view('admin.push_notifications.show')->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            alert()->error('Notification no encontrad@');

            return redirect(route('admin.push_notifications.index'));
        }

        return view('admin.push_notifications.edit')->with('notification', $notification);
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param int                       $id
     * @param UpdateNotificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            alert()->error('Notification no encontrad@');

            return back();
        }

        $notification = $this->notificationRepository->update($request->input(), $id);

        alert()->success('Notification actualizad@ exitosamente.');

        return back();
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            alert()->error('Notification no encontrad@');

            return redirect(route('admin.push_notifications.index'));
        }

        $this->notificationRepository->delete($id);

        alert()->success('Notification eliminad@ exitosamente.');

        return redirect(route('admin.push_notifications.index'));
    }
}
