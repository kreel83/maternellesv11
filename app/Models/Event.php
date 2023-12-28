<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin IdeHelperEvent
 */
class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Retourne la liste des prochains évènements du calendrier
     *
     * @return App\Models\Event
     */
    public static function listeDesProchainsEvenements() {
        return self::select('date', 'name')
        ->where('user_id', Auth::id())
        ->whereDate('date', '>=', Carbon::now())
        ->get();
    }
}
