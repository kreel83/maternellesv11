<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;

class Commentaire extends Model
{
    use HasFactory;





    public function formatTexte() {
        $pos = strpos($this->texte, '@name@');
        if ($pos === 0) return str_replace('@name@',"<span class='prenom_dans_phrase'>L'élève</span>",$this->texte);
        return str_replace('@name@',"<span class='prenom_dans_phrase'>l'élève</span>",$this->texte);
    }

    public function texte($enfant) {
        return Utils::traitement($this->texte, $enfant);
    }
}
