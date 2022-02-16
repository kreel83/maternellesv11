<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;

class Commentaire extends Model
{
    use HasFactory;





    public function texte($enfant) {
        return Utils::traitement($this->texte, $enfant);
    }
}
