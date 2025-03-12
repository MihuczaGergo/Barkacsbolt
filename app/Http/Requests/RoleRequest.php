<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleRequest extends FormRequest
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
            "name" => "required|max:20|unique:roles,name",
        ];
    }

    public function messages() {
        return [
            "name.required" => "Jogosultság név kötelező!",
            "name.max" => "Túl hosszú jogosultság név!",
            "name.unique" => "Létező jogosultság név!",
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => "Beviteli hiba",
            "data" => $validator -> errors()
        ]));
    }
}