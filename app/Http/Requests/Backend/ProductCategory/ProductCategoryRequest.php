<?php

namespace App\Http\Requests\Backend\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'cat_img'       => 'required|mimes: jpeg,png,jpg,JPEG,JPG,PNG,gif', 
        ];
    }
}
