<?php

namespace App\Http\Requests\Backend\Stall;

use Illuminate\Foundation\Http\FormRequest;

class StallVisitorRequest extends FormRequest
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
            'stall_id' => 'required',
            'customer_id' => 'required'
        ];
    }
}
