<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptTypePayRequest extends FormRequest
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

        ];
    }

    public function messages()
    {
        return [
            'name.required'=>' نوع الايصال مطلوب ',
            'branch_id.required'=>'الفرع مطلوب ',

        ];
    }
}
