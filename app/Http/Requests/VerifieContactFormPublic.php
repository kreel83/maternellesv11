<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifieContactFormPublic extends FormRequest
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
            'name' => ['nullable','string', 'max:255'],
            'phone' => ['nullable','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
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
            'email.required' => 'Adresse mail obligatoire.',
            'email.max' => 'Adresse mail limitée à 255 caractères.',
            'subject.required' => 'L\'objet du message est obligatoire.',
            'subject.max' => 'L\'objet du message est limité à 255 caractères.',
            'message.required' => 'Le message est obligatoire.',
            'g-recaptcha-response' => 'Merci de vérifier que vous n\'êtes pas un robot',
        ];
    }

}
