<?php


namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class ValidationException extends Exception
{
    protected $validator;

    protected $code = 422;

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            "error" => "form validation error",
            "message" => $this->validator->errors()->first()
        ], $this->code);
    }
}
