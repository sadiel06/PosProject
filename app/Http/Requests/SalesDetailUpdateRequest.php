<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesDetailUpdateRequest extends FormRequest
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
            'sale_id' => ['required', 'integer', 'exists:sales,id'],
            'date_created' => ['required', 'date'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'softdeletes' => ['required'],
        ];
    }
}
