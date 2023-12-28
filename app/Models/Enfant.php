<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resultat;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

/**
 * @mixin IdeHelperEnfant
 */
class Enfant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'groupe' => 'integer',
    ];

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
        '1' => '#B71C1C',
        '2' => '#D32F2F',
        '3' => '#F44336',
        '4' => '#E57373',             
        '5' => '#4A148C',
        '6' => '#7B1FA2',
        '7' => '#9C27B0',            
        '8' => '#BA68C8',            
        '9' => '#311B92',
        '10' => '#512DA8',
        '11' => '#673AB7',
        '12' => '#9575CD',             
        '13' => '#004D40',
        '14' => '#00796B',
        '15' => '#009688',            
        '16' => '#4DB6AC',            
        '17' => '#E65100',
        '18' => '#F57C00',
        '19' => '#FF9800',
        '20' => '#FFB74D',             
        '21' => '#3E2723',
        '22' => '#5D4037',
        '23' => '#795548',            
        '24' => '#A1887F',            
        

    ];

    protected $dispatchesEvents = [
        'retrieved' => \App\Events\EleveEvent::class,
    ];


    public $mail1, $mail2, $mail3, $mail4, $photoEleve, $jour, $age, $groupeFormatted;


    public function item() {
          return $this->hasmany('App\Models\Item');
    }


    public function state_reussite_definitif() {
        $r = Reussite::where('enfant_id', $this->id)->where('definitif', 1)->orderBy('periode','DESC')->first();
        return $r ? 'P'.$r->periode : null;
    }

    public function state_reussite_last() {
        $r = Reussite::where('enfant_id', $this->id)->where('definitif', 0)->orderBy('periode','DESC')->first();
        return $r ? 'P'.$r->periode : null;
    }


    public function lastUser($l = false) {
        $user = User::find($this->user_n1_id);
        if ($user) return !$l ? $user->name.' '.$user->prenom : substr($user->name,0,1).substr($user->prenom,0,1);
        return 'nouvel élève';
    }

    public function lastProfId() {
        return $this->user_n1_id;
    }

    public function user_rel() {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function user() {
        return $this->hasOne('App\Models\User','id','user_id')->first();
    }

    public function formatPdf() {
        function rand_color() {
            $colors = ['#F3DA24','#F15E61','#51C5CF','#00B04C', '#FF914D', '#66ACE2', '#C9E265']; 

            $index = array_rand($colors);
            return $colors[$index];
        }
        $s = '';
        $prenom = ucfirst(strtolower($this->prenom));
        for ($i = 0; $i<strlen($prenom); $i++) {
            $s .= '<span style="color: '.rand_color().'">'.substr($prenom,$i,1).'<span>';
        }

        return $s;
    }

    public function resultat($item) {
        $r =  Resultat::where('enfant_id', $this->id)->where('item_id', $item)->where('notation',2)->where('autonome',1)->first();

        return $r;
    }

    public function directeur() {
        $directeur = json_decode(Auth::user()->configuration->direction);
        $arr = null;
        if ($directeur) $arr = [$directeur->civilite, $directeur->nom.' '.$directeur->prenom];
        return $arr;
        
    }

    public function cahier() {
        return Cahier::where('enfant_id', $this->id)->pluck('texte','section_id');
    }

    public function resultats() {
        $r = Resultat::where('enfant_id', $this->id)->where('notation',2)->where('autonome',1)->get();
        $r = $r->groupBy('section_id');
        return $r;

    }

    public function section() {
        $sec = [
            'ps' => 'Petite section',
            'ms' => 'Moyenne section',
            'gs' => 'Grande section',
        ];
        return $sec[$this->psmsgs];
    }

    public function nextSection($o) {
        if ($o == 'gs') return 'gs';
        if ($o == 'ms') return 'gs';
        if ($o == 'ps') return 'ms';

    }

    public function prevSection($o) {
        if ($o == 'gs') return 'ms';
        if ($o == 'ms') return 'ps';
        if ($o == 'ps') return 'ps';

    }

    public function periode() {
        $a = $this->periode;
        $conf = Auth::user()->configuration;
        $periodes = $conf->periodes;
        $periode = 
        [ 1 => [
           'Année entière' 
        ], 2 => ['Premier semestre','Second semestre'], 
        3 => ['Premier trimestre','Deuxième trimestre','Troisième trimestre']];
        



     
        return $periode[$periodes][$a -1];
    }

    public function hasReussite() {
        return $this->hasOne('App\Models\Reussite')->where('periode', $this->periode)->first();
    }

    public static function listeDesEleves() {
        // $liste = self::where('classe_id', session()->get('id_de_la_classe'))->get();
        return self::where('classe_id', session('classe_active')->id)->get();
    }

    public function tableauDesMailsEnfant() {
        $mails = array();
        for ($i=1; $i <= 4; $i++) { 
            if(filter_var($this->{"mail$i"}, FILTER_VALIDATE_EMAIL)) {
                $mails[] = $this->{"mail$i"};
            }
        }
        return $mails;
    }

}
