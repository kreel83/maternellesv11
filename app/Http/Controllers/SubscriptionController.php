<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends Controller
{
    /**
     * affiche l'écran de paiement
     *
     * @return View
     */
    public function cardform(): View
    {
        $product = Produit::produitAbonnementUser();
        $intent = auth()->user()->createSetupIntent();
        return view('subscription.cardform', compact("intent","product"));
    }

    /**
     * achat d'un abonnement par un User
     *
     * @param Request $request
     * @return View
     */
    public function subscribe(Request $request): View
    {
        $product = Produit::produitAbonnementUser();
        try {
            // ***************************************************
            // Utiliser un webhook pour gérer un failed peut etre mieux. A voir en production
            // ***************************************************
            $subscription = $request->user()->newSubscription('default', $product->stripe_product_id)
                ->create($request->token);
            // enregistrement de la transaction
            Transaction::ajouterUneTransactionAbonnementUser($request, $subscription, $product);
            return view("subscription.result")
                ->with('result', 'success');
        } catch (IncompletePayment $exception) {
            $message = $exception->payment->last_payment_error->message.' ('.$exception->payment->last_payment_error->type.')';
            //dd($exception->payment->last_payment_error->message);
            return view("subscription.result")
                ->with('result', $message);
            /*
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]
            );
            */
        }
        /*
        // retour $subscription
         #attributes: array:11 [▼
            "name" => "64c2c7e5da1cb"
            "stripe_id" => "sub_1NYa1rF73qwd826kfBytARcN"
            "stripe_status" => "active"
            "stripe_price" => "price_1NEXRRF73qwd826kHYATzqgl"
            "quantity" => 1
            "trial_ends_at" => null
            "ends_at" => null
            "user_id" => 47
            "updated_at" => "2023-07-27 19:39:22"
            "created_at" => "2023-07-27 19:39:20"
            "id" => 49
        ]
        */
    } 

    /**
     * affiche l'écran pour annuler un abonnement et demande confirmation
     *
     * @return View
     */
    public function cancel(): View
    {
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("subscription.cancel")
            ->with('onGracePeriode', false)
            ->with('finsouscription', $finsouscription);
    }

    /**
     * annule un abonnement après confirmation
     *
     * @return View
     */
    public function cancelsubscription(): View
    {
        Auth::user()->subscription('default')->cancel();
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("subscription.cancel")
            ->with('onGracePeriode', $onGracePeriode)
            ->with('finsouscription', $finsouscription);
    }

    /**
     * Réactive un abonnement
     *
     * @return View
     */
    public function resume(): View
    {
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        if ($onGracePeriode) {
            Auth::user()->subscription('default')->resume();
        }
        return view("subscription.resume")
            ->with('onGracePeriode', $onGracePeriode);
    }

    /**
     * Affiche la liste des factures
     *
     * @return View
     */
    public function invoice(): View
    {
        $invoices = Auth::user()->invoices();
        return view("subscription.invoice")
            ->with('invoices', $invoices);
    }

}
