<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProduit
 */
class Produit extends Model
{
    use HasFactory;

    /**
     * Renvoi le produit en cours pour créer les licences par un administrateur
     *
     * @return Produit
     */
    public static function produitEnCoursLicenceAdmin()
    {
        $dateDuJour = Carbon::now();
        return Produit::whereRaw('"'.$dateDuJour.'" between `available_from` and `available_to`')->first();
    }

    /**
     * Renvoi le produit en cours pour créer un abonnement (stripe) par un utilisateur
     *
     * @return Produit
     */
    public static function produitAbonnementUser()
    {
        return Produit::where('active_from', null)->first();
    }
}
