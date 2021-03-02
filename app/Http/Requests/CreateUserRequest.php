<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class CreateUserRequest extends FormRequest
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
        return User::$rules;
    }

    public function messages()
    {
        return [
            'dob.before' => 'Debes tener más de 18 años para tener una cuenta',
            'dob.date'  => 'La fecha de nacimiento es obligatoria',
        ];
    }
}
