<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ReussiteSection;

/**
 * @mixin IdeHelperReussite
 */
class Reussite extends Model
{
    use HasFactory, SoftDeletes;


    public function reussitesListe() {      
        
            $liste = ReussiteSection::where('reussite_id', $this->id)->pluck('description','section_id');

           
           
            if ($this->commentaire_general) {
                $liste[99] = $this->commentaire_general;
            }


            return $liste;

    }

    public function isUserCanUpdate() {
        $enfant = Enfant::find($this->enfant_id);
        if(!$enfant) {
            return false;
        }
        $classe = Classe::find($enfant->classe_id);
        if($classe->id != session('classe_active')->id) {
            return false;
        }
        if(Auth::id() != $classe->user_id) {
            $partage = ClasseUser::where('classe_id', $classe->id)
                            ->where('user_id', Auth::id())
                            ->first();
            if(!$partage) {
                return false;
            }
        }
        return true;
    }

}
