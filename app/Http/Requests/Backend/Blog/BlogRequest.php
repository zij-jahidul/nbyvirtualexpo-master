<?php

namespace App\Http\Requests\Backend\Blog;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed company_id
 * @property mixed user_id
 * @property mixed event_category_id
 * @property mixed title
 * @property mixed tropic
 * @property mixed feature_image
 * @property mixed live_broadcust
 * @property mixed description
 * @property mixed status
 */
class BlogRequest extends FormRequest
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
            'company_id'        => 'required',
            'user_id'           => 'required',
            'event_category_id' => 'required',
            'title'             => 'required|max:255',
            'tropic'            => 'required|max:255',
            'feature_image'     => 'required|mimes:jpeg,png,jpg,JPEG,JPG,PNG,gif',
            'live_broadcust'    => 'required|max:255',
            'description'       => 'required',
            'status'            => 'required',
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
