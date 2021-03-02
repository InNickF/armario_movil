<?php

namespace App\Services;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class FCMService
{
    private $url;
    private $store_email;
    private $store_password;
    private $company_email;
    private $company_password;

    public function __construct()
    {
       
    }


    public function sendPushNotification($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            alert()->error('Notification no encontrad@');

            return redirect(route('notifications.index'));
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

            // You must change it to get your tokens4
            //FIXME:: Dont send to all
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

}
