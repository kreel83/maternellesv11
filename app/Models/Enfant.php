<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resultat;

class Enfant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'retrieved' => \App\Events\EleveEvent::class,
    ];


    public $mail1, $mail2, $photoEleve, $jour;


    public function item() {
          return $this->hasmany('App\Models\Item');
    }



    public function user() {
        return $this->hasOne('App\Models\User','id','user_id')->first();
    }

    public function resultat($item) {
        $r =  Resultat::where('enfant_id', $this->id)->where('item_id', $item)->where('notation',2)->first();

        return $r;
    }

    public function cahier() {
        return Cahier::where('enfant_id', $this->id)->pluck('texte','section_id');
    }

    public function resultats() {
        $r = Resultat::where('enfant_id', $this->id)->where('notation',2)->get();
        $r = $r->groupBy('section_id');
        return $r;

    }


    public function hasReussite() {
        return $this->hasOne('App\Models\Reussite')->first();
    }
}
