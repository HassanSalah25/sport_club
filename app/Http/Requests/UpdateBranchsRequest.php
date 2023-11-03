<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchsRequest extends FormRequest
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
            "landline"=>"required",
            "phone"=>"required",
            "city"=>"required",
            "address"=>"required",
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم الفرع مطلوب ',
            'landline.required'=>'الخط الارضي مطلوب ',
            'phone.required'=>'الهاتف مطلوب ',
            'city.required'=>'المدينه مطلوب ',
            'address.required'=>'العوان مطلوب ',

        ];
    }
}
