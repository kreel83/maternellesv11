<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifieDDNTelechargementPdf extends FormRequest
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
            'jour' => ['required', 'integer', 'numeric'],
            'mois' => ['required', 'integer', 'numeric'],
            'annee' => ['required', 'integer', 'numeric'],
            'token' => ['required', 'string'],
            'g-recaptcha-response' => 'required|captcha',
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
            'jour' => 'Veuillez indiquer le jour de naissance.',
            'mois' => 'Veuillez indiquer le mois de naissance.',
            'annee' => 'Veuillez indiquer l\'année de naissance.',
            'token' => 'Token invalide.',
            'g-recaptcha-response' => 'Merci de vérifier que vous n\'êtes pas un robot.',
        ];
    }
}
