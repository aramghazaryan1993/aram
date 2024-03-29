<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdressMenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => 'required|min:2|max:100',
            'type'    => 'required|min:2|max:100',
            'url'    => 'required|min:2|max:100',
            'menu_id' => 'required|int',
        ];
    }
}
