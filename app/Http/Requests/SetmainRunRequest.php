<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetmainRunRequest extends FormRequest
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
            'cash' => 'regex:/^[0-9(),*\/.+-]+$/'
        ];
    }

    public function messages()
    {
        return [
            'cash.regex' => 'Сумма должна быть число и Арифметические знаки'
        ];
    }
    public function attributes()
    {
        return [
            'cash' => 'Сумма',
        ];
    }
}
