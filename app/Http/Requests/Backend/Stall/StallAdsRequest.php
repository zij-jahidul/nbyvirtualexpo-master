<?php

namespace App\Http\Requests\Backend\Stall;

use Illuminate\Foundation\Http\FormRequest;

class StallAdsRequest extends FormRequest
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
            'ads' => 'required',
            'adds_type' => 'required',
        ];
    }
}
