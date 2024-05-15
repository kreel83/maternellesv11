<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AchatController extends Controller
{
   
    public function buyWithStripeCheckout(Request $request)
    {
        // https://stripe.com/docs/api/checkout/sessions/create
        $product = Produit::produitAchatPremium();
        //Log::info($product);
        return $request->user()->checkout($product->stripe_product_id,
            [
                'success_url' => route('achat.success'),
                'cancel_url' => route('licence.index', ['checkout' => 'cancel']),
                'payment_intent_data' => [
                    'metadata' => [
                        'user_id' => $request->user()->id,
                        'produit_id' => $product->id,
                        'method' => 'achat',
                        'price' => $product->price,
                        'quantity' => 1,
                        'amount' => $product->price,
                    ]
                ]
            ]);
    } 

    public function buyWithStripeCheckoutSuccess()
    {
        session(['is_abonne' => true]);
        return view('achat.success');
    }

}
