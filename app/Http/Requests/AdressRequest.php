<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'map'            => 'required|string',
            'text'           => 'required|string',
            'adress_menu_id' => 'required|int',
        ];
    }
}
