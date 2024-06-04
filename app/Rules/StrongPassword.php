<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/[A-Z]/', $value) && // Vérifie la présence d'une majuscule
               preg_match('/\d/', $value) &&    // Vérifie la présence d'un chiffre
               preg_match('/[@$!%*?&]/', $value); // Vérifie la présence d'un caractère spécial
    }

    public function message()
    {
        return 'Le lot de passe de contenir au moins 1 majuscule, 1 minuscule, 1 nombre et un caractère spécial.';
    }
}
