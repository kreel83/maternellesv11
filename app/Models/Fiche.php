<?php

namespace App\Models;

use App\Events\FicheEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * @mixin IdeHelperFiche
 */
class Fiche extends Model
{
    use HasFactory;


    public $item;

    protected $dispatchesEvents = [
        'retrieved' => FicheEvent::class,
    ];


    public static function allFiches() {
        $fiches =  self::where('user_id', Auth::id())->orderBy('order')->get();
        $fiches = $fiches->groupBy('section_id');
        return $fiches;
    }

    public function item() {
        return $this->hasOne('App\Models\Item');
    }


    public static function lastOrder() {
        return self::where('user_id', Auth::id())->count() + 1;
    }

    public static function createDemoFiche($user) {
        $items = Item::whereNull('user_id')->where('lvl','010')->get();
        $groupes = $items->groupBy('section_id');
        
        foreach ($groupes as $key=>$groupe) {
            $order = 1;
            foreach ($groupe as $item) {
                $fiche = new Fiche();
                $fiche->user_id = $user->id;
                $fiche->item_id = $item->id;
                $fiche->order = $order;
                $fiche->section_id = $key;
                $fiche->perso = 1;
                $fiche->updated_at = Carbon::now();
                $fiche->created_at = Carbon::now();
                $fiche->save();   
                $order++;  

            }
        }
        //dd('done');
    }
}
