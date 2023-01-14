<?php

namespace App\Http\Requests\Backend\Visitor;

use Illuminate\Foundation\Http\FormRequest;

class VisitorPointRequest extends FormRequest
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
            'visitor_point_distribution_id' => 'required',
            'customer_id' => 'required'
        ];
    }
}
