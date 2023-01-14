<?php

namespace App\Http\Requests\Backend\EventCategory;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed event_category_name
 * @property mixed event_cat_img
 * @property mixed status
 */
class EventCategoryRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'event_category_name'   => 'required|max:100|min:3',
            'event_cat_img'         => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG,gif',
            // 'status'                => 'required',
            // 'created_by'                => 'created_by'
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
