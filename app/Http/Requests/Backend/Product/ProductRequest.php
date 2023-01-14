<?php

namespace App\Http\Requests\Backend\Product;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

/**
 * @property mixed stall_id
 * @property mixed product_category_id
 * @property mixed product_sub_category_id
 * @property mixed product_name
 * @property mixed product_code
 * @property mixed product_img
 * @property mixed color
 * @property mixed size
 * @property mixed cost_price
 * @property mixed selling_price
 * @property mixed wholesale_price
 * @property mixed offer_price
 * @property mixed description
 * @property mixed status
 * @property mixed created_by
 */
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'stall_id'                  => 'required',
            'product_category_id'       => 'required',
            'product_sub_category_id'   => 'required',
            'product_name'              => 'required|max:255',
            'product_code'              => 'required|max:255',
             'product_img'               => 'required',
            // 'color'                     => 'required|max:255',
            // 'size'                      => 'required|max:255',
            // 'cost_price'                => 'required|regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$',
            // 'selling_price'             => 'required|regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$',
            // 'wholesale_price'           => 'required|regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$',
            // 'offer_price'               => 'required|regex:^(?:[1-9]\d+|\d)(?:\,\d\d)?$',
            // 'description'               => 'required',
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}
