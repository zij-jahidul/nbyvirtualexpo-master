<?php

namespace App\Http\Requests\Backend\Visitor;

use Illuminate\Foundation\Http\FormRequest;

class VisitorPointDistributionRequest extends FormRequest
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
            'slug_name' => 'required|max:300',
            'point' => 'required',
        ];
    }
}
