<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\UserStore;

class UpdateUserStoreRequest extends FormRequest
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
        return [
             'name' => ['required', 'string', 'min:5', 'max:50'],
             'description' => ['required', 'string', 'min:5', 'max:50'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El nombre de tienda es requerido',
            'description.required' => 'La descripción de la tienda es requerida',
            // 'address.required' => 'La dirección de tienda es requerido',
            // 'city.required' => 'La ciudad de tienda es requerido',
            // 'latitude.required' => 'La latitud de tienda es requerido',
            // 'longitude.required' => 'La longitud de tienda es requerido',
        ];
    }
}
