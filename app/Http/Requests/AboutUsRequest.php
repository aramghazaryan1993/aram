<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'      => 'required|min:3|max:50',
            'mini_text'  => 'required|min:3|max:500',
            'image'      => 'required',
            'text'       => 'required',
        ];
    }
}
