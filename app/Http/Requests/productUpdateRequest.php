<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => ['required'],
            'category' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'category.required' => 'A category is required',
            'price.required' => 'A price is required',
            'stock.required' => 'A stock is required',
        ];
    }

}
