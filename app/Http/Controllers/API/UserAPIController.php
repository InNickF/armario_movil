<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Services\PaymentezService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\AppBaseController;

class UserAPIController extends \App\Http\Controllers\Controller
{


    public function me()
    {
        $user = auth('api')->user();

        if (empty($user)) {
            return $this->sendError('User no encontrad@');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }



    public function cards()
    {
        $paymentez = new PaymentezService();
        $cards = $paymentez->getLoggedUserCards(auth('api')->user()->id)->cards;
        foreach ($cards as $key => &$card) {
            // dd(Crypt::encryptString($card->token));

            $dbCards = auth('api')->user()->payment_methods()->get();
            $dbCard = null;
            foreach ($dbCards as $key => $c) {
                if (Crypt::decryptString($c->card_token) == ($card->token)) {
                    $dbCard = $c;
                }
            }
            // dd($dbCard);
            if ($dbCard != null) {
                $card->is_primary = $dbCard->is_primary;
            } else {
                unset($card);
            }
        }
        // if(!$cards) {
        //     return $this->sendError('No se encontraron tarjetas de este usuario');
        // }
        return $cards;
    }


    public function collecting_method()
    {
        $methods = auth('api')->user()->collecting_method()->with('bank')->get();
        // if(!$cards) {
        //     return $this->sendError('No se encontraron tarjetas de este usuario');
        // }
        return $methods;
    }

    public function updateCollectingMethod($id, Request $request)
    {
        $method = PaymentMethod::find($id);

        if (empty($method)) {
            return $this->sendError('No se ha encontrado el método de pago');
        }

        // $user = auth()->user();
        $input = $request->all();

        // if (isset($input['is_primary'])) {
        // if($input['is_primary'] == true) {
        //     /** Clear old primary */
        //     foreach ($user->collecting_methods as $key => $m) {
        //         if($m->is_primary) {
        //             $m->is_primary = false;
        //             $m->save();
        //         }
        //     }
        // }
        // $method->is_primary = $input['is_primary'];
        // }
        $method->save();

        // alert()->success('Método de pago actualizado.');
        return $this->sendResponse(['success' => true, 'method' => $method,  'input' => $input], 'Se ha actualizado el método de pago');
    }


    public function removeCollectingMethod($id, Request $request)
    {
        $method = PaymentMethod::find($id);

        if (empty($method)) {
            return $this->sendError('No se ha encontrado el método de pago');
        }

        $method->delete();

        return $this->sendResponse(['success' => true], 'Se ha borrado el método de pago');
    }



    public function addCreditCard(Request $request)
    {
        $input = $request->all();

        if (!$input['card_token']) {
            $this->sendError('No se ha encontrado el token de la tarjeta');
        }

        $user = auth('api')->user();

        $data = [
            'is_card' => true,
            'card_token' => Crypt::encryptString($input['card_token']),
            'name' => $input['holder_name'] ?? '?',
            'is_paying' => true,
            'is_primary' => !$user->payment_methods->count() ? true : false,
        ];
        $user->payment_methods()->create($data);
        // dd($data);
        return $this->sendResponse(['success' => true], 'Se ha agregado la tarjeta a tu perfil');
    }


    public function updateCreditCard(Request $request)
    {
        $input = $request->all();

        if (!$input['card_token']) {
            return $this->sendError('No se ha encontrado el token de la tarjeta');
        }

        $user = auth('api')->user();

        $dbCards = $user->payment_methods()->get();

        $dbCard = null;
        foreach ($dbCards as $key => $c) {
            $decrypted = Crypt::decryptString($c->card_token);
            if ($decrypted == $input['card_token']) {
                // dd($input['card_token']);
                $dbCard = $c;
            }
        }

        $paymentez = new PaymentezService();
        $cards = $paymentez->getLoggedUserCards(auth('api')->user()->id)->cards;
        $cards = collect($cards);
        $paymentezCard = $cards->where('token', $input['card_token'])->first();

        if (is_null($dbCard)) {
            $dbCard = $user->payment_methods()->create([
                'is_card' => true,
                'card_token' => Crypt::encryptString($input['card_token']),
                'name' => $paymentezCard->holder_name,
                'is_paying' => true,
                'is_primary' => !$user->payment_methods->count() ? true : false,
            ]);
        }
        // dd($dbCard);

        if (isset($input['is_primary']) && !empty($input['is_primary'])) {

            if ($input['is_primary'] == true) {
                /** Clear old primary */
                foreach ($user->payment_methods as $key => $method) {
                    if ($method->is_primary) {
                        $method->is_primary = false;
                        $method->save();
                    }
                }
            }
            // dd($dbCard);
            $dbCard->is_primary = $input['is_primary'];

            $dbCard->save();
        }

        return $this->sendResponse(['success' => true], 'Se ha actualizado la tarjeta');
    }

    public function removeCreditCard(Request $request)
    {
        $input = $request->all();

        if (!isset($input['token'])) {
            return $this->sendError('No se ha enviado el token de la tarjeta');
        }

        // dd($input['token']);

        $paymentez = new PaymentezService();
        $card = $paymentez->removeCard($input['token']);
        if (is_array($card) && isset($card['error'])) {
            return $this->sendError($card['error']);
        }

        $user = auth('api')->user();
        $method = $user->payment_methods()->where([
            'card_token' => Crypt::encryptString($input['token']),
        ])->first();

        if ($method) {
            $method->delete();
        }

        return $this->sendResponse(['success' => true], 'Se la borrado la tarjeta');
    }


    public function fcm(Request $request)
    {
        if ($request->has('token')) {
            $this->sendError('No se ha enviado el token de FCM');
        }

        $user = auth('api')->user();
        $user->fcm_token = $request->get('token');
        $user->save();

        $this->sendResponse($user, 'Se ha guardado el token de FCM exitosamente');
    }
}