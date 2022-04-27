<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
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
            'region_id' => ['required', 'integer', 'exists:regions,id'],
            'province_id' => ['required', 'string'],
            'municipality_id' => ['required', 'integer', 'exists:municipalities,id'],
            'softdeletes' => ['required'],
        ];
    }
}
