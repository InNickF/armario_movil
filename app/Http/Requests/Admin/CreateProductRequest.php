<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class CreateProductRequest extends FormRequest
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
            'store_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            // 'images' => 'required',
            // 'main_image' => 'required',
        ];
    }
}
