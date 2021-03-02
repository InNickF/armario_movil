<?php

namespace App\Http\Requests\API;

use App\Models\Outfit;
use InfyOm\Generator\Request\APIRequest;

class UpdateOutfitAPIRequest extends APIRequest
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
            'name' => 'required',
            'description' => 'required',
            'features' => 'required|array',
            'products' => 'required|array',
            'media' => 'required'
        ];
    }
}
