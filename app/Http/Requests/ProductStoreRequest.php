<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'product_title' => 'required|min:15|max:250|unique:products',
            // 'category_id' => 'required',
            // 'images' => 'required',
            // 'tags' => 'required',
            // 'price' => 'required',   
        ];
    }
}
