<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneUpdateRequest extends FormRequest
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
            'phonable_id' => ['required', 'integer', 'gt:0'],
            'phonable_type' => ['required', 'string'],
            'number_phone' => ['required', 'string'],
            'softdeletes' => ['required'],
        ];
    }
}
