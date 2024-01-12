<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmeClasseRequest extends FormRequest
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
            'ecole_id' => ['required', 'max:8', 'min:8', 'exists:ecoles,identifiant_de_l_etablissement'],
            'description' => ['required', 'string'],
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
            'ecole_id.required' => 'Veuillez indiquer l\'identifiant de votre établissement.',
            'ecole_id.min' => 'L\'identifiant de l\'établissement doit avoir 8 caractères minimum.',
            'ecole_id.max' => 'L\'identifiant de l\'établissement doit avoir 8 caractères maximum.',
            'ecole_id.exists' => 'L\'identifiant de votre établissement est introuvable. Vérifiez votre saisie.',
            'description.required' => 'Veuillez donner un nom à votre classe.',
        ];
    }
}
