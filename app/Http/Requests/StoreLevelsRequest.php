<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLevelsRequest extends FormRequest
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
            "name"=>"required",
            "branch_id"=>"required",
            "sport_id"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'branch_id.required'=>'الفرع مطلوب ',
            'sport_id.required'=>' اللعبه مطلويه ',
            'name.required'=>' اسم المستوي مطلوب  ',


        ];
    }
}
