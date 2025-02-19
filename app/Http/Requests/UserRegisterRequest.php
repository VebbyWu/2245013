<?php

namespace App\Http\Requests;

use illuminate\contracts\validation\validators;
use Illuminate\Foundation\Http\FormRequest;
use illuminate\http\exceptions\httpResponseException;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    protected function failedvalidation(validator $validator)
    {
        throw new httpResponseException(response([
            'errors' => $validator->getmessagebag(),
        ], 400));
    } 
}
