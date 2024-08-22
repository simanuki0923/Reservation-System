<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|string|max:255|unique:admins,name,' . $this->id,
            'password' => 'nullable|string|min:5',
            'role' => 'required|string|max:255',
        ];
    }

    public function messages()
    {

        return [
            'name.required' => '名前は必須です。',
            'name.unique' => 'この名前は既に存在します。',
            'password.min' => 'パスワードは最低5文字である必要があります。',
            'role.required' => '役割は必須です。',
        ];
    }
}
