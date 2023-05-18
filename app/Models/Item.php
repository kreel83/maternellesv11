<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;
use App\Events\ItemEvent;
use App\Models\resultat;

class Item extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'retrieved' => ItemEvent::class,
    ];

    public function section() {
        return $this->hasMany('App\Models\Section','id','section_id')->first();
    }

    public function image() {
        return $this->belongsTo('App\Models\Image');
    }

    public function phrase($enfant) {
        return Utils::traitement($this->phrase, $enfant);
    }

    public function resultat($enfant) {
        $arr = [0 => null, 1 => "En voie d'acquisition", 2 => "Acquis"];
        $r = Resultat::where('enfant_id', $enfant)->where('item_id', $this->id)->first();
        if (!$r) return null;
        return [$r->notation, $r->autonome, $arr[$r->notation ?? null]];
    }


}
