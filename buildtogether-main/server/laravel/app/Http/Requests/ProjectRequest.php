<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name'=> 'required|min:3',
            'summary' => 'required|min:50',
            'ptype'=>['required',Rule::in(['longTerm', 'hackathon'])],
            'category'=>['required',Rule::in(['technology', 'marketing','education','finance','business'])],
            'totalFund' => 'nullable',
            'achievedFund' => 'nullable',
            'startDate' => 'required_if:ptype,==,hackathon',
            'endDate' => 'required_if:ptype,==,hackathon',
            'photo' => 'nullable|image',


        ];
    }
}