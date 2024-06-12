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
            'attestation'=> ['required'],
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
            'jour.required' => 'Veuillez indiquer le jour de naissance.',
            'jour.integer' => 'Jour incorrect.',
            'jour.numeric' => 'Jour incorrect.',
            'mois.required' => 'Veuillez indiquer le mois de naissance.',
            'mois.integer' => 'Mois incorrect.',
            'mois.numeric' => 'Mois incorrect.',
            'annee.required' => 'Veuillez indiquer l\'année de naissance.',
            'annee.integer' => 'Année incorrecte.',
            'annee.numeric' => 'Année incorrecte.',
            'token.required' => 'Token invalide.',
            'attestation.required' => 'Veuillez cocher la case attestant prendre connaissance du document.',
            'g-recaptcha-response' => 'Merci de vérifier que vous n\'êtes pas un robot.',
        ];
    }
}
