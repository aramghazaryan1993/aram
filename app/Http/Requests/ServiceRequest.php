<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:3|max:100',
            'image' => 'required|string',
            'text' => 'required',
            'text_header' => 'required|string|min:3|max:250',
            'menu_id' => 'required'
        ];
    }
}
