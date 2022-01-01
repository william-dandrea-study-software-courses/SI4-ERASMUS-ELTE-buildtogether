<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'nullable|min:2',
            'last_name' => 'nullable|min:2',
            'title'=> 'nullable|min:2',
            'summary'=> 'nullable|min:10',
            'tel' => 'nullable|min:10',
            'photo' => 'nullable',
            'cv' => 'nullable'
        ];
    }
}