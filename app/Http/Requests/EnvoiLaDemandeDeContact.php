<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnvoiLaDemandeDeContact extends FormRequest
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
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
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
            'subject.required' => 'Veuillez indiquer l\'objet du message',
            'subject.string' => 'Format de l\'objet incorrect',
            'subject.max' => 'L\'objet peut contenir au maximum 255 caractères',
            'message.required' => 'Veuillez indiquer le contenu de votre message',
            'message.string' => 'Format du message incorrect',
        ];
    }
}
