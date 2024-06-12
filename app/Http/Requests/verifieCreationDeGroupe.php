<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class verifieCreationDeGroupe extends FormRequest
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
            'groupName' => ['required', 'string', 'max:12'],
            'token' => ['required'],
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
            'groupName.required' => 'Le nom du groupe est obligatoire.',
            'groupName.max' => 'Le nom du groupe est limité à 12 caractères.',
            'token.required' => 'Token invalide.',
        ];
    }

}
