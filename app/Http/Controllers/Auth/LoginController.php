<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\CartModel;
use App\Mail\UserRegistered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (request()->get('from') == 'checkout') {
            session()->put('step', true);
            session()->put('from', url()->previous());
        }
        if (request()->has('temp')) {
            session()->put('temp', request()->get('temp'));
        }
        return view('auth.login');
    }

    public function authenticated($request, $user)
    {
        $redirect = session()->pull('from', $this->redirectTo);
        $temp = session()->pull('temp', false);
        $queryParams = '';

        $step = session()->pull('step', false);
        if (isset($step) && $step == true) {
            $queryParams = '?step=2';
        }

        if (isset($temp) && !empty($temp)) {
            $existing_user = \App\User::find($temp);
            if (!$existing_user) {
                CartModel::transferCart($temp, $user->id);
            }
        }

        return redirect($redirect . $queryParams);
    }




    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $email = $user->getEmail();

        if(!$email) {
            \Log::error('Social Provider EMAIL not found');
            alert()->error('Ha ocurrido un error al iniciar sesión, por favor vuelve a intentarlo');
            return back();
        }
        $existingUser = User::where('email', $email)->first();

        if (is_null($existingUser)) {
            $newUser = User::create([
                $provider . '_token' => $user->token,
                $provider . '_id' => $user->getId(),
                // $provider . '_id' => $user->getNickname(),
                'first_name' => $user->getName(),
                'email' => $email,
            ]);
            $newUser->assign('user');
            $newUser->saveAvatarImage($user->getAvatar(), false);

            Auth::login($newUser, true);
            try {
                Mail::to($newUser)->send(new UserRegistered($newUser));
            } catch (\Throwable $th) {
                \Log::error($th);
            }


            // $redirect = session()->pull('from', $this->redirectTo);
            $temp = session()->pull('temp', false);
            $queryParams = '';

            $step = session()->pull('step', false);
            if (isset($step) && $step == true) {
                $queryParams = '?step=2';
            }

            if (isset($temp) && !empty($temp)) {
                $existing_user = \App\User::find($temp);
                if (!$existing_user) {
                    CartModel::transferCart($temp, $newUser->id);
                }
            }

            return redirect(url('account/profile'));
        }

        $existingUser->{$provider . '_token'} = $user->token;
        $existingUser->{$provider . '_id'} = $user->getId();

        $existingUser->save();

        Auth::login($existingUser, true);


        $redirect = session()->pull('from', $this->redirectTo);
        $temp = session()->pull('temp', false);
        $queryParams = '';

        $step = session()->pull('step', false);
        if (isset($step) && $step == true) {
            $queryParams = '?step=2';
        }

        if (isset($temp) && !empty($temp)) {
            $existing_user = \App\User::find($temp);
            if (!$existing_user) {
                CartModel::transferCart($temp, $existingUser->id);
            }
        }

        return redirect($redirect . $queryParams);
    }



    public function logout(Request $request)
    {
        /** Remove FCM Token */
        $user = auth()->user();

        if ($user) {
            $user->fcm_token = null;
            $user->save();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}