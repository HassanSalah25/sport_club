<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTournamentsRequest extends FormRequest
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
            "cost"=>"required",
            "subscribe_value"=>"required",
            "date"=>"required",
//            "file_name"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم اللعبه مطلوب ',
            'branch_id.required'=>'الفرع مطلوب ',
            'cost.required'=>'التكلفه مطلوب ',
            'subscribe_value.required'=>'قيمه الاشتراك مطلوب ',
            'date.required'=>'تاريخ المسابقه مطلوب ',
//            'file_name.required'=>'اسم الملف  مطلوب ',

        ];
    }
}
