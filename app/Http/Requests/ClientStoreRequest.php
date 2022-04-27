<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'entity_id' => ['required', 'integer', 'exists:entities,id'],
            'name' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'cedula' => ['required', 'string', 'max:18'],
            'softdeletes' => ['required'],
        ];
    }
}
