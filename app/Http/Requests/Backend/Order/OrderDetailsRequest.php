<?php

namespace App\Http\Requests\Backend\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailsRequest extends FormRequest
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
            'order_id'      => 'required',
            'product_id'    => 'required',
            'quantity'      => 'required',
            'color'         => 'required|max:200',
            'size'          => 'required|max:200',
            'price'         => 'required',
        ];
    }
}
