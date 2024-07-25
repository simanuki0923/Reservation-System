<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'reservation_date' => ['required', 'date'],
            'reservation_time' => ['required', 'date_format:H:i'],
            'number_of_people' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日は必須です。',
            'reservation_date.date' => '有効な日付を入力してください。',
            'reservation_time.required' => '予約時間は必須です。',
            'reservation_time.date_format' => '有効な時間形式（HH:MM）を入力してください。',
            'number_of_people.required' => '人数は必須です。',
            'number_of_people.integer' => '人数は整数でなければなりません。',
            'number_of_people.min' => '人数は少なくとも1人でなければなりません。',
        ];
    }
}
