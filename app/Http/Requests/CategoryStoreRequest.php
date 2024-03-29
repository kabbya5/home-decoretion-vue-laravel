<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
        $rule =  [
            'categoryName' => 'required|min:5|unique:categories',
            ];
        switch($this->method()){
            case "GET":
                $rule['categoryImg'] = 'required';
            case "PATCH":
            case "PUT": 
                $rule['categoryName'] = 'required|min:5|unique:categories,categoryName,'.$this->category->id;
                $role['categoryImg']  = '';
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'categoryName.required' => 'Categegory Name is Required',
        ];
    }
}
