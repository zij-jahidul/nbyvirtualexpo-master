<?php

namespace App\Http\Requests\Backend\EventCategory;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed event_category_id
 * @property mixed event_sub_category_name
 * @property mixed event_sub_cat_img
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 */
class EventSubCategoryRequest extends FormRequest
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
            'event_category_id'         => 'required',
            'event_sub_category_name'   => 'required|max:255|min:3',
            'event_sub_cat_img'         => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG,gif',
            
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    // public function failedValidation(Validator $validator)
    // {
    //     throw new ValidationException($validator);
    // }
}
