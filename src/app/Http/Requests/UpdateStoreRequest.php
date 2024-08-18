<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ];
    }

    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください。',
            'area.required' => 'エリアを入力してください。',
            'genre.required' => 'ジャンルを入力してください。',
            'description.required' => '説明を入力してください。',
            'image_url.url' => '有効なURLを入力してください。',
        ];
    }
}
