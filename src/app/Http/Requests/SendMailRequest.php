<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'subject' => 'required|string|max:255', // Added 'subject' validation
            'message' => 'required|string', // Keep 'message' validation
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名を入力してください。',
            'message.required' => 'メッセージを入力してください。',
        ];
    }
}