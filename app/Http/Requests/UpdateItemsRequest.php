<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemsRequest extends FormRequest
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
            "item_name"=>"required",
            "item_value"=>"required|max:250",
            "type"=>"required",

        ];
    }

    public function messages()
    {
        return [
            'type.required'=>' نوع البند مطلوب ',
            'item_name.required'=>' اسم البند مطلوب ',
            'item_value.required'=>' قيمه البند مطلوب ',


        ];
    }
}
