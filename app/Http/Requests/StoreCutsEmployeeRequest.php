<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCutsEmployeeRequest extends FormRequest
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
            "employee_id"=>"required",
            "price"=>"required|numeric",
            "date"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'employee_id.required'=>'الموظف مطلوب ',
            'price.required'=>' المبلغ مطلوب ',
            'date.required'=>'التاريخ مطلوب ',


        ];
    }
}
