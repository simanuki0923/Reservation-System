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
            'reservation_date' => ['date'],
            'reservation_time' => ['date_format:H:i'],
            'number_of_people' => ['integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.date' => '予約日は必須です。',

            'reservation_time.date_format' => '予約時間は必須です。',

            'number_of_people.integer' => '人数は必須です。',
        ];
    }
}
