<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
            'party_size' => 'required|integer|min:1|max:20',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日を選択してください。',
            'reservation_date.date' => '有効な日付を選択してください。',
            'reservation_date.after_or_equal' => '予約日は今日以降の日付にしてください。',
            'reservation_time.required' => '予約時間を選択してください。',
            'reservation_time.date_format' => '有効な時間形式（HH:MM）で入力してください。',
            'party_size.required' => '人数を入力してください。',
            'party_size.integer' => '人数は整数で入力してください。',
            'party_size.min' => '人数は1以上でなければなりません。',
            'party_size.max' => '人数は20以下でなければなりません。',
            'restaurant_id.required' => 'レストランIDが必要です。',
            'restaurant_id.exists' => '選択されたレストランIDは無効です。',
        ];
    }
}
