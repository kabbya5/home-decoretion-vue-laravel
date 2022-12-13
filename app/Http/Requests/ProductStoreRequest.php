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
        $rule = [
            'product_title' => 'required|min:15|max:250|unique:products',
            'category_id' => 'required',
            'images' => 'required',
            'tags' => 'required|max:7',
            'price' => 'required', 
            'short_text' => 'required|min:50|max:500',
            'quantity' => 'required',  
            'sizes' => 'required',
            'colors' => 'required',
        ];

        switch($this->method()){
            case 'PATCH':
            case 'PUT':
                $rule['product_title'] = 'required|min:5|unique:products,product_title,'.$this->product->id;
        }
        return $rule;
    }
}
