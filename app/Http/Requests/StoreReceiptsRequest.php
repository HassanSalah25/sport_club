<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptsRequest extends FormRequest
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
            "from"=>"required",
            "to"=>"required",
            "from_type"=>"required",
            "amount"=>"required",
            "date"=>"required",


        ];
    }

    public function messages()
    {
        return [
            'from.required'=>' يرجي اختيار من  ',
            'to.required'=>'  يرجي اختيار الي  ',
            'from_type.required'=>'  يرجي اختيار نوع من   ',
            'amount.required'=>'  الاجمالي  مطلوب  ',
            'date.required'=>' تاريخ الايصال مطلوب  ',


        ];
    }
}
