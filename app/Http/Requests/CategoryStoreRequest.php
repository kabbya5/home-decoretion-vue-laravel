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
        //     'categoryImgName' => 'required',
            ];
        switch($this->method()){
            case "PATCH":
            case "PUT": 
                $rule['categoryName'] = 'required|min:5|unique:categories,categoryName,'.$this->category->id;
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'categoryName.required' => 'Categegory Name is Required',
            'categoryImg.required' => "Category image is Required",
            // 'categoryImgName.required' => "Category image name is Required",
        ];
    }
}
