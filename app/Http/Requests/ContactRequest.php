<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ContactRequest
 * @property string $phone
 * @property string $email
 * @property string  $working
 * @property string  $text_header
 * @property string  $text_footer
 * @property string  $facebook
 * @property string  $instagram
 * @property string  $logo_header
 * @property string  $logo_footer
 * @package App\Http\Requests
 */
class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'       => 'required|min:2|max:50',
            'email'       => 'required|email',
            'working'     => 'required',
            'text_header' => 'required|min:2|max:250',
            'text_footer' => 'required|min:2',
            'facebook'    => 'required|min:2|max:250',
            'instagram'   => 'required|min:2|max:250',
            'logo_header' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'logo_footer' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ];
    }
}
