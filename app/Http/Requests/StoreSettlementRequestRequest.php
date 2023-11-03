<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettlementRequestRequest extends FormRequest
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

    public function rules()
    {
        return [
            "custody_id"=>"required",
            "to"=>"required",
        ];
    }

    public function messages()
    {
        return [
            'from.required'=>' يرجي اختيار العهده  ',
            'to.required'=>'  يرجي اختيار خزانه او بنك  ',
        ];
    }
}
