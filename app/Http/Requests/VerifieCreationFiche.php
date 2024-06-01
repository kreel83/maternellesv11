<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class VerifieCreationFiche extends FormRequest
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
            'section_id' => ['required'],
            'categorie_id' => ['required'],
            'section' => ['required'],
            'name' => ['required'],
            'phrase' => [
                'required',
                'regex:/(?:^|\W)Tom(?:$|\W)/',
                
            ],
            'file' => [File::image()],
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
            'section_id.required' => 'Le domaine est obligatoire.',
            'categorie_id.required' => 'Une catégorie doit être sélectionnée.',
            'section.required' => 'Une ou plusieurs sections doivent etre affectées à la fiche.',
            'name.required' => 'Le titre de la fiche est obligatoire',
            'phrase.required' => 'La phrase pré-enregistrée est obligatoire',
            'phrase.regex' => 'La phrase doit contenir le prénom Tom obligatoirement',
            'file' => "Le fichier envoyé n'est pas une image valide",
        ];
    }

}
