<?php

namespace App\Http\Requests\API;

use App\Models\Product;
use InfyOm\Generator\Request\APIRequest;

class CreateProductAPIRequest extends APIRequest
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
            'store_id' => 'exists:user_stores,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            // 'subcategory_id' => 'required',
            // 'subsubcategory_id' => 'required',
            'has_guarantee' => 'sometimes|boolean',
            'has_discount' => 'sometimes|boolean',
            // 'features' => 'required',
            'example_size' => 'required',
            'condition' => 'required',
            'style' => 'required',
            // 'guarantee_time_months' => 'required_if:has_guarantee,true|numeric|lte:24',
            // 'discounted_price' => 'sometimes|numeric',
        ];
    }
}