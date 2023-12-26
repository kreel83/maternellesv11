<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Reussite;
use App\Models\Enfant;
use App\Models\ReussiteSection;
use App\utils\Utils;

class Resultat extends Model
{
    use HasFactory;

    protected $casts = [
        'item_id' => 'integer',
        'enfant_id' => 'integer',
        'section_id' => 'integer',
        'notation' => 'integer',
        'autonome' => 'integer',
    ];

	/**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'item_id',
        'enfant_id',
        'notation',
        'section_id',
        'user_id',
        'groupe',
        'autonome',
    ];


    public static function boot() {

	    parent::boot();

	    static::created(function($resultat) {
            if ($resultat->notation == 2 && $resultat->autonome == 1) {
                $r = Reussite::where('user_id', Auth::id())->where('periode', $resultat->periode)->where('enfant_id', $resultat->enfant_id)->where('definitif', 0)->first();
                if ($r)  {
                    $s = ReussiteSection::where('section_id', $resultat->section_id)->where('reussite_id', $r->id)->first();           
                    if ($s) {
                        $enfant = Enfant::find($resultat->enfant_id);                    
                        $exp = explode('</p>',$s->description);                        
                        array_splice($exp, 1, 0, '<p>'.$resultat->item($enfant));                    
                        foreach ($exp as $key=>$e) {
                            if (str_contains($e,'<p>')) {
                                $exp[$key] =  $exp[$key].'</p>';
                            }
                        }
                        $exp = join($exp);
                        $s->description = $exp;
                        $s->save();
                    }              
                }                
            }

	    });

	    static::updating(function($resultat) {
            if ($resultat->notation == 2 && $resultat->autonome == 1) {
                $r = Reussite::where('user_id', Auth::id())->where('periode', $resultat->periode)->where('enfant_id', $resultat->enfant_id)->where('definitif', 0)->first();
                if ($r)  {
                    $s = ReussiteSection::where('section_id', $resultat->section_id)->where('reussite_id', $r->id)->first();           
                    if ($s) {
                        $enfant = Enfant::find($resultat->enfant_id);                    
                        $exp = explode('</p>',$s->description);                        
                        array_splice($exp, 1, 0, '<p>'.$resultat->item($enfant));                    
                        foreach ($exp as $key=>$e) {
                            if (str_contains($e,'<p>')) {
                                $exp[$key] =  $exp[$key].'</p>';
                            } 

                        }
                        $exp = join($exp);
                        $s->description = $exp;
                        $s->save();
                    }              
                }                
            }
	    });
    
	}




    public function notation() {
        return $this->hasone('App\models\Notation','id','notation_id')->first();
    }

    public function item($enfant) {
        $search =  $this->hasOne('App\Models\Item','id','item_id')->first();
        Utils::commentaire($search, $enfant->prenom, $enfant->genre);
        return $enfant->genre == 'F' ?  $search->phrase_feminin : $search->phrase_masculin;
        
    }

    public function top5ElevesLesPlusAvances() {
        return self::selectRaw('count(*) as total, enfants.nom, enfants.prenom, enfants.groupe, enfants.background, enfants.photo')
        ->join('enfants', 'enfants.id', '=', 'enfant_id')
        // ->where('enfants.classe_id', session()->get('id_de_la_classe'))
        ->where('enfants.classe_id', session('classe_active')->id)
        ->groupBy('enfant_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
    }

    public function top5ElevesLesMoinsAvances() {
        return self::selectRaw('count(*) as total, enfants.nom, enfants.prenom, enfants.groupe, enfants.background, enfants.photo')
        ->join('enfants', 'enfants.id', '=', 'enfant_id')
        // ->where('enfants.classe_id', session()->get('id_de_la_classe'))
        ->where('enfants.classe_id', session('classe_active')->id)
        ->groupBy('enfant_id')
        ->orderBy('total')
        ->limit(5)
        ->get();
    }

    public function top5DisciplinesLesPlusAvances() {
        return self::selectRaw('count(*) as total, items.name, sections.id')
        ->join('items', 'items.id', '=', 'item_id')
        ->join('sections', 'sections.id', '=', 'items.section_id')
        ->join('enfants', 'enfants.id', '=', 'resultats.enfant_id') 
        // ->where('enfants.classe_id', session()->get('id_de_la_classe'))
        ->where('enfants.classe_id', session('classe_active')->id)
        ->groupBy('item_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
    }

    public function top5DisciplinesLesMoinsAvances() {
        return self::selectRaw('count(*) as total, items.name, sections.id')
        ->join('items', 'items.id', '=', 'item_id')
        ->join('sections', 'sections.id', '=', 'items.section_id')
        ->join('enfants', 'enfants.id', '=', 'resultats.enfant_id') 
        // ->where('enfants.classe_id', session()->get('id_de_la_classe'))
        ->where('enfants.classe_id', session('classe_active')->id)
        ->groupBy('item_id')
        ->orderBy('total')
        ->limit(5)
        ->get();
    }

    public function listeDesEnfantsSansNote() {
        $r = Enfant::where('user_id', Auth::id())->count();
        // dd($r);
        $c = self::rightJoin('enfants','enfants.id','enfant_id')
        // ->where('enfants.classe_id', session()->get('id_de_la_classe'))
        ->where('enfants.classe_id', session('classe_active')->id)
        ->whereNull('resultats.enfant_id')
        ->count();

        return $c;
    }

    public static function resultatsPourUnEleve($id) {
        $resultats = Resultat::select('resultats.id','resultats.section_id','notation','autonome','items.name as itemName','sections.name as sectionName','resultats.section_id',
            'sections.logo as sectionLogo')
            ->where('enfant_id', $id)
            ->leftJoin('items', 'item_id', '=', 'items.id')
            ->leftJoin('sections', 'resultats.section_id', '=', 'sections.id')
            ->orderBy('resultats.section_id')
            ->get();
        return $resultats;
    }

}
