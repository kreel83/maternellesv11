<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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


    public function notation() {
        return $this->hasone('App\models\Notation','id','notation_id')->first();
    }

    public function item() {
        $search =  $this->hasOne('App\Models\Item','id','item_id')->first();
        if ($search) return $search;
        $search =  $this->hasOne('App\Models\Personnel','id','item_id')->first();
        return $search;
    }

    public function top5ElevesLesPlusAvances() {
        return self::selectRaw('count(*) as total, enfants.nom, enfants.prenom, enfants.groupe, enfants.background, enfants.photo')
        ->join('enfants', 'enfants.id', '=', 'enfant_id')
        ->where('enfants.user_id', Auth::id())
        ->groupBy('enfant_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
    }

    public function top5ElevesLesMoinsAvances() {
        return self::selectRaw('count(*) as total, enfants.nom, enfants.prenom, enfants.groupe, enfants.background, enfants.photo')
        ->join('enfants', 'enfants.id', '=', 'enfant_id')
        ->where('enfants.user_id', Auth::id())
        ->groupBy('enfant_id')
        ->orderBy('total')
        ->limit(5)
        ->get();
    }

    public function top5DisciplinesLesPlusAvances() {
        return self::selectRaw('count(*) as total, items.name, sections.logo')
        ->join('items', 'items.id', '=', 'item_id')
        ->join('sections', 'sections.id', '=', 'items.section_id')
        ->where('resultats.user_id', Auth::id())
        ->groupBy('item_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
    }

    public function top5DisciplinesLesMoinsAvances() {
        return self::selectRaw('count(*) as total, items.name, sections.logo')
        ->join('items', 'items.id', '=', 'item_id')
        ->join('sections', 'sections.id', '=', 'items.section_id')
        ->where('resultats.user_id', Auth::id())
        ->groupBy('item_id')
        ->orderBy('total')
        ->limit(5)
        ->get();
    }

    public static function resultatsPourUnEleve($id) {
        $resultats = Resultat::select('autonome','items.name as itemName','sections.name as sectionName','resultats.section_id',
            'sections.logo as sectionLogo')
            ->where('enfant_id', $id)
            ->leftJoin('items', 'item_id', '=', 'items.id')
            ->leftJoin('sections', 'resultats.section_id', '=', 'sections.id')
            ->orderBy('resultats.section_id')
            ->get();
        return $resultats;
    }

}
