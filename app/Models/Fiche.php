<?php

namespace App\Models;

use App\Events\FicheEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        return $this->hasOne('Item');
    }
    public static function lastOrder() {
        return self::where('user_id', Auth::id())->count() + 1;
    }
}
