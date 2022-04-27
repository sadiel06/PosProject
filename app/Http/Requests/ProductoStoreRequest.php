<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoStoreRequest extends FormRequest
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
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'status_id' => ['required', 'integer'],
            'size_id' => ['integer', 'exists:sizes,id'],
            'register_date' => ['required', 'date'],
            'price' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
            'cost' => ['required', 'string'],
        ];
    }
}
