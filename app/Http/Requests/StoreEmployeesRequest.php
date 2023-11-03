<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeesRequest extends FormRequest
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
            "email"=>"required",
            "password"=>"required",
//            "phone"=>"nullable|numeric|min:10|max:11",
//            "phone2"=>"nullable|numeric|min:10|max:11",

        ];
    }

    public function messages()
    {
        return [
            'name.required'=>' اسم المدرب مطلوب ',
            'email.required'=>'  ايميل مطلوب ',
            'password.required'=>'  الرقم السري مطلوب ',
            'phone.numeric'=>'   الرجاء ادخل رقم هاتف صحيح ولا يتعدي 11 رقم',
            'phone2.numeric'=>'     الرجاء ادخل رقم هاتف صحيح   ولا يتعدي 11 رقم ',


        ];
    }
}
