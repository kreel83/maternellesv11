<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\utils\Utils;
use App\Events\ItemEvent;
use App\Models\Resultat;

class Item extends Model
{
    public static $FIRE_EVENTS = true;

    protected $casts = [
        'section_id' => 'integer',
    ]; 

    public $image_name;

    // const NOTATION = [
    //     "0" => ["backgroundColor" => "rgb(105,240,174)",'textColor' => 'black'],
    //     "1" => ["backgroundColor" => "rgb(68,138,174)",'textColor' => 'white'],
    //     "2" => ["backgroundColor" => "rgb(105,240,174)",'textColor' => 'black'],
    //     "3" => ["backgroundColor" => "rgb(105,240,174)",'textColor' => 'black'],
    // ];


    protected $dispatchesEvents = [
        'retrieved' => ItemEvent::class,
    ];

    public function section() {
        return $this->hasMany('App\Models\Section','id','section_id')->first();
    }

    public function categorie() { 
        // $c = Categorie::find($this->categorie_id);
        // dd($c, $this);
        // return $c ? $c->section_2 : null;
        return $this->belongsTo('App\Models\Categorie');
    }

    public function image() {
        return $this->belongsTo('App\Models\Image');
    }



    public function resultat($enfant) {
        $arr = [0 => null, 1 => "En voie d'acquisition", 2 => "Acquis"];
        $r = Resultat::where('enfant_id', $enfant)->where('item_id', $this->id)->first();
        if (!$r) return null;
        if ($r->autonome == 0 && $r->notation == 2) $arr[$r->notation] = $arr[$r->notation].' avec aide';
        return [$r->notation, $r->autonome, $arr[$r->notation ?? null]];
    }


}
