<?php

namespace App\Http\Requests\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

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
            // $rules['email'] = $rules['email'].',email,'.$requestID;
            $rules['email'] = 'sometimes';
            // dd($rules['email']);
        }

        return $rules;
    }
}
