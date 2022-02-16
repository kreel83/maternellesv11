<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resultat;

class Enfant extends Model
{
    use HasFactory;

    public function item() {
          return $this->hasmany('App\Models\Item');
    }



    public function user() {
        return $this->hasOne('App\Models\User','id','user_id')->first();
    }

    public function resultat($item) {
        $r =  Resultat::where('enfant_id', $this->id)->where('item_id', $item)->first();
        if (!$r) return null;
        $r->color = ($r->notation() ) ? $r->notation()->color : null;
        return $r;
    }

    public function cahier($periode) {
        return Cahier::where('enfant_id', $this->id)->where('periode', $periode)->pluck('texte','section_id');
    }

    public function resultats() {
        $r = Resultat::where('enfant_id', $this->id)->get();
        $r = $r->groupBy('section_id');
        return $r;

    }

}
