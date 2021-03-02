<?php

namespace App\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;
use Validator;

class UserHasCompleteProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $messages = [
            'dob.before' => 'Debes tener más de 18 años para tener una cuenta',
            'dob.date'  => 'La fecha de nacimiento es obligatoria',
            'first_name.required'  => 'El nombre es requerido',
            'last_name.required'  => 'El apellido es requerido',
            'city.required'  => 'La ciudad es requerida',
            'state.required' => 'La provincia es requerida',
            'gender.required'  => 'El género es requerido',
            'dob.required'  => 'La fecha de nacimiento es requerida',
        ];
        // dd($request->user()->toArray());
        $validator = Validator::make($request->user()->toArray(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['sometimes', 'min:10', 'max:10'],
            'city' => ['required', 'string', 'min:1'],
            'gender' => ['required', 'string'],
            'dob' => 'required|date|before:-18 years',
        ], $messages);

        if ($validator->fails()) {
            alert()->info('Completa tus datos de perfil para continuar');
            return redirect('/account/profile')->withErrors($validator);
        }

        return $next($request);
    }
}
