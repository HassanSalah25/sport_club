<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerContractsRequest extends FormRequest
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
            "percentage"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم اللعبه مطلوب ',
            'branch_id.required'=>'الفرع مطلوب ',
            'percentage.required'=>'النسبه مطلوبه ',

        ];
    }
}
