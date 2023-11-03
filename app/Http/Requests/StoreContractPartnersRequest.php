<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractPartnersRequest extends FormRequest
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
            "from_company"=>"required",
            "to_company"=>"required",
            "from_date"=>"required",
            "to_date"=>"required",
            "file"=>"required",
            "file_name"=>"required",
            "percentage"=>"required",
            "type_of_contract"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'from_employee.required'=>' الطرف الاول مطلوب ',
            'from_company.required'=>' الطرف الطرف التاني مطلوب ',
            'from_date.required'=>'  مده التعاقد من  مطلوب ',
            'to_date.required'=>' مده التعاقد الي مطلوب ',
            'file.required'=>'   ملف العقد مطلوب ',
            'file_name.required'=>'   اسم العقد مطلوب ',
            'percentage.required'=>' قيمه النبسه مطلوبه ',
            'type_of_contract.required'=>' نوع التعاقد  مطلوب ',


        ];
    }
}
