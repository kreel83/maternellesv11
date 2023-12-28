<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperVacance
 */
class Vacance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ecole_code_academie',
        'description',
        'population',
        'start_date',
        'end_date',
        'location',
        'zones',
        'annee_scolaire',
    ];

    /**
     * Liste des prochaines vacances pour le code_academie en session 'classe_active'
     *
     * @return App\Models\Vacances
     */
    public static function listeDesProchainesVacances() {
        return self::select('start_date', 'description')
        ->where('ecole_code_academie', session('classe_active')->code_academie)
        ->whereDate('start_date', '>=', Carbon::now())
        ->get();
    }


}
