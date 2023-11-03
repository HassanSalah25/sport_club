<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSportsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            "name"=>"required",
            "branch_id"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم اللعبه مطلوب ',
            'branch_id.required'=>'الفرع مطلوب ',

        ];
    }
}
