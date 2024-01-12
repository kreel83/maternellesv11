<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AjoutePartageRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'notIn:'.Auth::user()->email],
            'role' => ['required', 'string'],
            // 'code' => ['required', 'integer', 'digits:6'],
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
            'email.required' => 'Adresse e-mail obligatoire.',
            'email.max' => 'Adresse e-mail limitée à 255 caractères.',
            'email.email' => 'Adresse e-mail incorrecte.',
            'email.not_in' => 'Adresse e-mail incorrecte. Vous ne pouvez pas partager une classe avec vous-même.',
            'role.required' => 'Veuillez choisir un rôle pour la personnes qui aura accès à votre classe.',
            // 'code.required' => 'Code de sécurité obligatoire.',
            // 'code.integer' => 'Le code de sécurité doit être composé de 6 chiffres.',
            // 'code.digits' => 'Le code de sécurité doit être composé de 6 chiffres.',
        ];
    }

}
