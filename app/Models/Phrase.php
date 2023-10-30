<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;

class Phrase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function commentaire($enfant) {
        $commentaire = Commentaire::find($this->commentaire_id);
        Utils::commentaire($commentaire, $enfant->prenom, $enfant->genre);
        return $enfant->genre == 'F' ?  $commentaire->phrase_feminin : $commentaire->phrase_masculin;


        return $this->hasOne('App\Models\Commentaire');
    }
}
