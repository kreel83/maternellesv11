<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resultat;

class Enfant extends Model
{
    use HasFactory;

    protected $guarded = [];

    const DEGRADE = [
        'b1' => 'linear-gradient(120deg, #f6d365 0%, #fda085 100%)',
        'b2' => 'linear-gradient(-20deg, #b721ff 0%, #21d4fd 100%);',
        'b3' => 'linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%);',
        'b4' => 'linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);',             
        'b5' => 'linear-gradient(to top, #30cfd0 0%, #330867 100%);',
        'b6' => 'linear-gradient(to top, #fddb92 0%, #d1fdff 100%);',             
        'b7' => 'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%);',
        'b8' => 'linear-gradient(to right, #ff758c 0%, #ff7eb3 100%);',
        'b9' => 'linear-gradient(to top, #0ba360 0%, #3cba92 100%);'
                     
    ];
    
    const GROUPE_COLORS = [
        '#c1' => '#fd5959',
        '#c2' => '#ff9c6d',
        '#c3' => '#fcff82',
        '#c4' => '#afc5ff',             
        '#c5' => '#a1c45a',
        '#c6' => '#fff9e0',
        '#c7' => '#f1c550',            
        '#c8' => '#ea4c4c',            
        

    ];

    protected $dispatchesEvents = [
        'retrieved' => \App\Events\EleveEvent::class,
    ];


    public $mail1, $mail2, $photoEleve, $jour, $age;


    public function item() {
          return $this->hasmany('App\Models\Item');
    }


    public function lastUser() {
        $user = User::find($this->user_n1_id);
        if ($user) return $user->name.' '.$user->prenom;
        return 'nouvel élève';
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
