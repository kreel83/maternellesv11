<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resultat;
use Illuminate\Support\Facades\Auth;

class Enfant extends Model
{
    use HasFactory;

    protected $guarded = [];

    const DEGRADE = [
        'b1' => 'linear-gradient(to top, #f6d365 0%, #fda085 100%)',
        'b2' => 'linear-gradient(to top, #b721ff 0%, #21d4fd 100%);',
        'b3' => 'linear-gradient(to top, #b8cbb8 0%, #ee609c 100%);',
        'b4' => 'linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);',             
        'b5' => 'linear-gradient(to top, #30cfd0 0%, #330867 100%);',
        'b6' => 'linear-gradient(to top, #fddb92 0%, #d1fdff 100%);',             
        'b7' => 'linear-gradient(to top, #d4fc79 0%, #96e6a1 100%);',
        'b8' => 'linear-gradient(to top, #ff758c 0%, #ff7eb3 100%);',
        'b9' => 'linear-gradient(to top, #0ba360 0%, #3cba92 100%);',
        // 'b10' => '0ba360:0ba360'    // ligne degradé à créer dans eventEnfant                 
    ];
    
    const GROUPE_COLORS_FONT = [
        '1' => '#FFFFFF',
        '2' => '#000000',
        '3' => '#C2C2C2',
          
        

    ];
    const GROUPE_COLORS = [
        '1' => '#fd5959',
        '2' => '#ff9c6d',
        '3' => '#fcff82',
        '4' => '#afc5ff',             
        '5' => '#a1c45a',
        '6' => '#fff9e0',
        '7' => '#f1c550',            
        '8' => '#ea4c4c',            
        

    ];

    protected $dispatchesEvents = [
        'retrieved' => \App\Events\EleveEvent::class,
    ];


    public $mail1, $mail2, $photoEleve, $jour, $age;


    public function item() {
          return $this->hasmany('App\Models\Item');
    }


    public function lastUser($l = false) {
        $user = User::find($this->user_n1_id);
        if ($user) return !$l ? $user->name.' '.$user->prenom : substr($user->name,0,1).substr($user->prenom,0,1);
        return 'nouvel élève';
    }

    public function lastProfId() {
        return $this->user_n1_id;
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

    public static function listeDesEleves() {
        $liste = self::where('user_id', Auth::id())->get();
        return $liste;
    }

}
