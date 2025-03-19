<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            "name" => "required|max:15|unique:users,name",
            "email" => "required|email|unique:users,email",
            "password" => ["required","min:6","regex:/[a-z]/","regex:/[A-Z]/","regex:/[0-9]/" ],
            "confirm_password" => "required|same:password",
            "address" => "required"
        ];
    }

    public function messages() {
        return [
            "name.required" => "Név kötelező!",
            "name.max" => "Túl hosszú név!",
            "name.unique" => "Létező név!",
            "email.required" => "E-mail kötelező!",
            "email.unique" => "Létező e-mail!",
            "password.required" => "Jelszó kötelező!",
            "password.min" => "Túl rövid jelszó!",
            "password.regex" => "A jelszónak tartalmazia kell kisbetűt, nagybetűt és számot!",
            "confirm_password" => "Jelszó nem egyezik!",
            "address.required" => "Cím megadása kötelező!"
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
