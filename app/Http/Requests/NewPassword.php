<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Rules\StrongPassword;

class NewPassword extends FormRequest
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
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:9',
                'max:20',
                new StrongPassword,
            ]            
        ];
    }

    /**
     * Get the custom messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.required' => 'Mot de passe obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe a échoué.',
            'password.min' => 'Le mot de passe doit contenir au moins 9 caractères.',
            'password.max' => 'Le mot de passe doit contenir au plus 20 caractères.',
            'password.StrongPassword' => 'The password must include at least one uppercase letter, one number, and one special character.',
                    ];
    }

}
