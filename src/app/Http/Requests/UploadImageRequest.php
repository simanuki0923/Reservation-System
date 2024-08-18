<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'image.required' => '画像を選択してください。',
            'image.image' => '画像ファイルをアップロードしてください。',
            'image.mimes' => 'JPEG、PNG、JPG、GIF形式のファイルを選択してください。',
            'image.max' => '画像サイズは2MB以下にしてください。',
        ];
    }
}
