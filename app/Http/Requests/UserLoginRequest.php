<?php

namespace App\Http\Requests;

use illuminate\contracts\validation\validator;
use Illuminate\Foundation\Http\FormRequest;
use illuminate\http\exceptions\httpResponseexception;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|max:100',
        ];
    }

    protected function failedValidation(validator $validator)
    {
        throw new httpresponseexception(response([
            'errors' => $validator->getmessagebag(),            
        ], 400));
    }
}
