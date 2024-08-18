<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'restaurant_id' => 'required|exists:restaurants,id',
            'reservation_id' => 'nullable|exists:reservations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255', // 最大文字数を255に統一
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
            'restaurant_id.required' => 'レストランを選択してください。',
            'restaurant_id.exists' => '選択したレストランは存在しません。',
            'rating.required' => '評価を入力してください。',
            'rating.integer' => '評価は整数でなければなりません。',
            'rating.min' => '評価は1以上でなければなりません。',
            'rating.max' => '評価は5以下でなければなりません。',
            'comment.string' => 'コメントは文字列でなければなりません。',
            'comment.max' => 'コメントは255文字以内でなければなりません。', // 255文字に修正
        ];
    }
}
