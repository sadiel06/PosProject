<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
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
            'date_created' => ['required', 'date'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'total' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'point_of_sales_id' => ['required', 'integer', 'exists:point_of_sales,id'],
            'client_id' => ['integer', 'exists:clients,id'],
            'softdeletes' => ['required'],
        ];
    }
}
