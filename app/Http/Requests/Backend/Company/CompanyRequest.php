<?php

namespace App\Http\Requests\Backend\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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

            'company_name'          => 'required|max  : 100|min: 3',
            'company_img'           => 'required|mimes: jpeg,png,jpg,JPEG,JPG,PNG,gif',
            'event_sub_category_id' => 'required',
            'company_expire_date'   => 'required',
            // 'company_description'   => 'required'

        ];
    }
}
