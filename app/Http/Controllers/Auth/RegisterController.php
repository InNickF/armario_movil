<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\CartModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account/profile';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $messages = [
            'dob.before' => 'Debes tener más de 18 años para tener una cuenta',
            'dob.date'  => 'La fecha de nacimiento es obligatoria',
            'first_name.required'  => 'El nombre es requerido',
            'last_name.required'  => 'El apellido es requerido',
            'password.confirmed'  => 'Las contraseñas no coinciden',
        ];

        $validator = Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'city' => ['required', 'string', 'min:1'],
        ], $messages);

        if($validator->fails()) {
            alert()->error('Ha ocurrido un error al crear el usuario: ' . $validator->errors()->first());
        }

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            // 'city' => $data['city'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assign('user');

        Log::info('sending UserRegistered email');
        try {
            Mail::to($user)->send(new UserRegistered($user));
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return $user;
    }


    public function showRegistrationForm()
    {
        // if (request()->get('from') == 'checkout') {
        //     session()->put('step', true);
        // }

        // if (!session()->has('from')) {
        //     session()->put('from', url()->previous());
        // }

        // if (!request()->has('temp')) {
        //     session()->put('temp', request()->get('temp'));
        // }
        return view('auth.login');
    }

    public function registered($request, $user)
    {
        $redirect = session()->pull('from', $this->redirectTo);
        $temp = session()->pull('temp', false);
        $queryParams = '';
        
        $step = session()->pull('step', false);
        if (isset($step) && $step == true) {
            $queryParams = '?step=2';
        }

        // dd($temp );
        if(isset($temp) && !empty($temp)) {
            $existing_user = \App\User::find($temp);
             if(!$existing_user) {
                CartModel::transferCart($temp, $user->id);
            }
        }

        alert()->success('Tu cuenta ha sido creada');

        return redirect($redirect . $queryParams);
    }
}
