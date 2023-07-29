<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;


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
        return self::selectRaw('count(*) as total, enfants.nom, enfants.prenom')
        ->join('enfants', 'enfants.id', '=', 'enfant_id')
        ->groupBy('enfant_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
    }

    public function top5ElevesLesMoinsAvances() {
        return self::selectRaw('count(*) as total, enfants.nom, enfants.prenom')
        ->join('enfants', 'enfants.id', '=', 'enfant_id')
        ->groupBy('enfant_id')
        ->orderBy('total')
        ->limit(5)
        ->get();
    }

    public function top5DisciplinesLesPlusAvances() {
        return self::selectRaw('count(*) as total, items.name')
        ->join('items', 'items.id', '=', 'item_id')
        ->groupBy('item_id')
        ->orderByDesc('total')
        ->limit(5)
        ->get();
    }

    public function top5DisciplinesLesMoinsAvances() {
        return self::selectRaw('count(*) as total, items.name')
        ->join('items', 'items.id', '=', 'item_id')
        ->groupBy('item_id')
        ->orderBy('total')
        ->limit(5)
        ->get();
    }

}
