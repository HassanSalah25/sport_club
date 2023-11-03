<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackagesRequest  extends FormRequest

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
            "name"=> [
                "required",
                Rule::unique('packages')->ignore($this->route('package'))
            ],
            "sport_id"=>"required",
            "price"=>"required",
            "number_of_training"=>"required",
            "total_of_training"=>"required",
            "total_price"=>"required",
            "price_list_id.*" => "required|integer",

        ];
    }

    public function messages()
    {
        return [
            'sport_id.required'=>' اللعبه مطلويه ',
            'name.required'=>' اسم الباكدج مطلوب  ',
            'name.unique'=>' اسم الباكدج مكرر  ',
            'price.required'=>'  السعر مطلوب  ',
            'number_of_training.required'=>'  عدد المرات مطلوب  ',
            'total_of_training.required'=>'  اجمالي المبلغ ف الفئه مطلوب  ',
            'total_price.required'=>'  اجمالي سعر الباكدج  مطلوب  ',
            'manuel_price.required'=>'  اجمالي سعر اليدوي الباكدج  مطلوب  ',
            "price_list_id.*.integer" => "اسم قائمة الاسعار مطلوبة",

        ];
    }
}
