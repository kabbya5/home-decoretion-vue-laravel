<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
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
            'page_title' => 'required|max:70',
            'company_name' => 'required',
            'company_phone' => 'required|regex:/(01)[0-9]{9}/',
            'company_phone_2' => 'regex:/(01)[0-9]{9}/',
            'company_email'   => 'required|email',
            'company_email_2' => 'email',
        ];
        return $rule;
    }
}
