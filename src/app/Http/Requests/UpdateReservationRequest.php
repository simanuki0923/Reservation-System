<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
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
            'reservation_date.required' => '予約日を入力してください。',
            'reservation_date.date' => '予約日は正しい日付形式でなければなりません。',
            'reservation_time.required' => '予約時間を入力してください。',
            'reservation_time.date_format' => '予約時間は「H:i」形式で入力してください。',
            'number_of_people.required' => '人数を入力してください。',
            'number_of_people.integer' => '人数は整数でなければなりません。',
            'number_of_people.min' => '人数は1以上でなければなりません。',
        ];
    }
}
