<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClasse
 */
class Classe extends Model
{
    use HasFactory;

    public function ecole() {
        return $this->hasOne('App\Models\Ecole','identifiant_de_l_etablissement','ecole_identifiant_de_l_etablissement');
    }

    public static function is_enfants() {
        return Enfant::where('classe_id', session('classe_active')->id)->count() > 0;
    }

    public function state() {
        return $this;
    }

    public function directeur() {
        return json_decode($this->direction);
    }

    public function directeur_civilite() {
        $directeur = $this->direction;        
        $d = json_decode($directeur);
        return $d->civilite ?? null;
    }

    public function classe() {
        return $this->hasMany('App\Models\Enfant','classe_id');
    }

    public function maitresse() {
        return $this->belongsTo('App\Models\User','user_id');
    }

}
