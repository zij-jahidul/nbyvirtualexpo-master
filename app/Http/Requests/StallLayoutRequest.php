<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed event_sub_category_id
 * @property mixed layout_name
 * @property mixed layout_img
 * @property mixed layout_color
 * @property mixed layout_size
 * @property mixed layout_description
 * @property mixed created_by
 * @property mixed status
 * @property mixed company_id
 * @property mixed logo_image
 */
class StallLayoutRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'layout_name'               => 'required|max:255|min:3',
            'layout_color'              => 'required|max:255|min:3',
            'layout_size'               => 'required|max:255',
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}
