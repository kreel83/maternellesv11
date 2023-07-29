<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    /**
     * Renvoi le produit en cours pour créer les licences par un administrateur
     *
     * @return void
     */
    public static function produitEnCoursLicenceAdmin()
    {
        $dateDuJour = Carbon::now();
        $product = Produit::whereRaw('"'.$dateDuJour.'" between `available_from` and `available_to`')->first();
        return $product;
    }

    /**
     * Renvoi le produit en cours pour créer un abonnement (stripe) par un utilisateur
     *
     * @return Produit
     */
    public static function produitAbonnementUser()
    {
        $product = Produit::where('active_from', null)->first();
        return $product;
    }
}
