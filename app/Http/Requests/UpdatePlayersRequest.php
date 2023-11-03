<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayersRequest extends FormRequest
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
            "birth_day"=>"required",
            "join_date"=>"required",
            "father_name"=>"required",
            "father_phone"=>"required",
            "father_job"=>"required",
            "father_email"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'branch_id.required'=>'الفرع مطلوب ',
            'sport_id.required'=>' اللعبه مطلويه ',
            'name.required'=>' اسم اللاعب مطلوب  ',
            'birth_day.required'=>' تاريخ الميلاد مطلوب  ',
            'join_date.required'=>' تاريخ الالتحاق مطلوب  ',
            'father_name.required'=>' اسم الاب مطلوب  ',
            'father_phone.required'=>' رقم الهاتف مطلوب  ',
            'father_job.required'=>' الزظيفه مطلوب  ',
            'father_email.required'=>' البريد الالكتروني مطلوب  ',


        ];
    }
}
