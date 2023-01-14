<?php

namespace App\Http\Requests\Backend\Stall;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed company_id
 * @property mixed stall_layout_id
 * @property mixed event_sub_category_id
 * @property mixed stall_name
 * @property mixed brand_name
 * @property mixed manufacturer_name
 * @property mixed open_time
 * @property mixed close_time
 * @property mixed stall_description
 * @property mixed stall_live_boardcust
 * @property mixed stall_announcement
 * @property mixed status
 * @property mixed created_by
 */
class StallRequest extends FormRequest
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
			'company_id'                => 'required',
			'stall_layout_id'           => 'required',
			'event_sub_category_id'     => 'required',
			'stall_name'                => 'required|max:255|min:3',
			'brand_name'                => 'required|max:255|min:3',
			'manufacturer_name'         => 'required|max:255|min:3',
			'open_time'                 => 'required',
			'close_time'                => 'required',
			'stall_description'         => 'required',
			'stall_live_boardcust'      => 'required',
			'stall_announcement'        => 'required|min:3',
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator) {
        throw new ValidationException($validator);
    }
}
