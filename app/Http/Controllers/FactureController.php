<?php

namespace App\Http\Controllers;

use App\Models\Facture;

class FactureController extends Controller
{
    
    public function ajouterUneFacture(array $stripeObject)
    {
        $facture = new Facture();
        $facture -> user_id = '';
        Facture::create([
            'user_id' => $stripeObject['data']['object']['metadata']['user_id'],
            'produit_id' => $stripeObject['data']['object']['metadata']['produit_id'],
            'txid' => $stripeObject['data']['object']['id'],
            'method' => $stripeObject['data']['object']['metadata']['method'],
            'price' => $stripeObject['data']['object']['metadata']['price'],
            'quantity' => $stripeObject['data']['object']['metadata']['quantity'],
            'amount' => ($stripeObject['data']['object']['amount'] / 100),
            'customer' => $stripeObject['data']['object']['customer'],
            'status' => $stripeObject['data']['object']['status'],
        ]);
        return $facture;
    }

}
