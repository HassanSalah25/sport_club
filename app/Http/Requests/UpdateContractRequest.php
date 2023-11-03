<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            "from_employee"=>"required",
            "to_employee"=>"required",
            "from_date"=>"required",
            "to_date"=>"required",
            "item_id"=>"required",
            "item_value"=>"required",
            "type_of_contract"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'from_employee.required'=>' الطرف الاول مطلوب ',
            'to_employee.required'=>' الطرف الطرف التاني مطلوب ',
            'from_date.required'=>'  مده التعاقد من  مطلوب ',
            'to_date.required'=>' مده التعاقد الي مطلوب ',
            'item_id.required'=>'  البند مطلوب ',
            'item_value.required'=>' قيمه البند مطلوب ',
            'type_of_contract.required'=>' نوع التعاقد  مطلوب ',


        ];
    }
}
