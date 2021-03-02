<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $rules = User::$rules;
        $rules['password'] = 'sometimes';

        $rules['city'] = 'required|string';
        $rules['gender'] = 'required|string';
        $rules['phone'] = 'required|string';
        $rules['dob'] = 'required|date|before:-18 years';
        $rules['last_name'] = 'required|string|max:255'; // * Make required on edit profile because social login could create with no last_name
        // get ID of the user being edited.
        $requestID = (int) Auth::user()->id;

        // get user code from the request (form data), cast the value per your models design.
        $requestCode = (int) $this->email;

        // fetch current user code from db, if there is a better way to do this part, please let me know
        $user = user::where('id', $requestID)->first();

        // get current user code
        $currentCode = $user->email;

        /*
         * Now check if the "email" field will be updated.
         * If the "email" field isn't being updated, we need to change the rule to ignore the unique value.
         * If "email" is being updated we want to make sure it's unique.
         */
        if ($requestCode == $currentCode) {
            // update didn't change user code, so we want to ignore this id for the unique validation.
            // dd($rules['email']);
            $rules['email'] = $rules['email'].',email,'.$requestID;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'dob.before' => 'Debes tener más de 18 años para tener una cuenta',
            'dob.date'  => 'La fecha de nacimiento es obligatoria',
            'first_name.required'  => 'El nombre es requerido',
            'last_name.required'  => 'El apellido es requerido',
            'city.required'  => 'La ciudad es requerida',
            'state.required' => 'La provincia es requerida',
            'gender.required'  => 'El género es requerido',
            'dob.required'  => 'La fecha de nacimiento es requerida',
            // 'phone.required'  => 'El número de teléfono es requerido',
        ];
    }
    
}
