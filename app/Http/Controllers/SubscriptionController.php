<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Produit;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationResumeSubscription;
use App\Models\Ecole;
use App\Models\Facture;
use App\Models\FactureLigne;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use PDF;

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

    public function subscribe2(Request $request) {
        
        $user = $request->user();
        $product = Produit::produitAbonnementUser();
        //$plan = $request->input('plan');

        $paymentIntent = $user->createSetupIntent();
        dd($paymentIntent);
        $subscription = $user->newSubscription('default', $product->stripe_product_id)
            ->create($paymentIntent->id);

        $paymentIntent = PaymentIntent::retrieve($paymentIntent->id);

        if ($paymentIntent->status === 'requires_action') {
            return redirect()->route('cashier.payment', [
                'payment_intent_client_secret' => $paymentIntent->client_secret,
                'success_url' => route('subscription.success'),
                'cancel_url' => route('subscription.cancel'),
            ]);
        }

        // Subscription created successfully
        return redirect()->route('subscription.success');
        

    }

    /**
     * achat d'un abonnement par un User
     *
     * @param Request $request
     * @return View
     */
    public function subscribe(Request $request)
    {
        $product = Produit::produitAbonnementUser();
        try {
            $subscription = $request->user()->newSubscription('default', $product->stripe_product_id)
                ->create($request->token, [
                    'email' => $request->user()->email,
                ], [
                    'metadata' => [
                        'user_id' => $request->user()->id,
                        'produit_id' => $product->id,
                        'method' => 'subscription',
                        'price' => $product->price,
                        'quantity' => 1,
                        'amount' => $product->price,
                    ]
                ]);
            //dd($subscription);
            /*
            'user_id' => Auth::id(),
            'produit_id' => $product->id,
            'subscription_id' => $subscription->id,
            'txid' => $subscription->stripe_id,
            'method' => 'subscription',
            'price' => $product->price,
            'quantity' => 1,
            'amount' => $product->price,
            'customer' => Auth::user()->stripe_id,
            'status' => $subscription->stripe_status,
            */
            /*
            // Déporté dans StripeEventListener.php
            // enregistrement de la transaction
            Transaction::ajouterUneTransactionAbonnementUser($request, $subscription, $product);
            // mise a jour du type de licence dans Users
            User::where('id', Auth::user()->id)->update(['licence' => 'self']);
            // mise à jour des variables session pour gérer le menu abonnement
            UserController::setMenuAbonnement($request);
            */
            // mise à jour des variables session pour gérer le menu abonnement
            UserController::setMenuAbonnement();
            return view("subscription.result")
                ->with('result', 'succeeded');
        }
        catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('user.stripe.redirect')]
            );
        }
        catch (CardException $exception) {
            $json = $exception->getJsonBody();
            $message = $json['error']['message'].' ('.$json['error']['type'].')';
            return view("subscription.result")
                ->with('result', $message);
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

    public function stripeRedirect(Request $request) {
        // mise à jour des variables session pour gérer le menu abonnement
        UserController::setMenuAbonnement();
        return view("subscription.result")
                ->with('result', $request->success);
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
    public function cancelsubscription(Request $request): View
    {
        Auth::user()->subscription('default')->cancel();
        UserController::setMenuAbonnement();
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
    public function resume(Request $request): View
    {
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("subscription.resume")
            ->with('onGracePeriode', $onGracePeriode)
            ->with('finsouscription', $finsouscription);
    }

    public function resumeSubscription(Request $request)
    {
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $cancelled = Auth::user()->subscription('default')->canceled();
        if ($cancelled && $onGracePeriode) {
            Auth::user()->subscription('default')->resume();
            $result = Auth::user()->subscribed('default') ? true : false;
            if($result) {
                UserController::setMenuAbonnement();
                Mail::to(Auth::user()->email)->send(new ConfirmationResumeSubscription());
            }
        } else {
            $result = false;
        }
        return back()->with(["result" => $result]);
    }

    /**
     * Affiche la liste des factures
     *
     * @return View
     */
    public function invoice(): View
    {
        //$invoices = Auth::user()->invoices();
        $invoices = Facture::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view("subscription.invoice")
            ->with('invoices', $invoices);
    }

    /**
     * Affiche le détail de l'abonnement en cours pour un User
     *
     * @return View
     */
    public function detailAbonnement(): View
    {
        $licenceType = Auth::user()->licence;
        $msgIfCanceled = "";
        switch($licenceType) {
            case 'admin':
                $licence = Licence::where([
                    ['user_id', Auth::user()->id],
                    ['actif', 1],
                ])->first();                
                $status = $licence ? 'actif' : 'expiré';
                $expirationDate = $licence->expires_at;
                $message = "Licence numéro $licence->name gérée par votre établissement.";
                break;
            case 'self':
                $status = Auth::user()->subscribed('default') ? 'actif' : 'expiré';
                $expirationDate = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
                $message = "Licence gérée par vous-même.";
                //$onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
                $cancelled = Auth::user()->subscription('default')->canceled();
                if($cancelled) {
                    $msgIfCanceled = "Vous avez résilié votre abonnement.";
                }
                break;
        }
        return view("subscription.detail")
            ->with('status', $status)
            ->with('expirationDate', $expirationDate)
            ->with('message', $message)
            ->with('msgIfCanceled', $msgIfCanceled);
    }

    public function downloadInvoice($number)
    {
        $invoice = Facture::select('factures.id','factures.number','factures.created_at','transactions.payment_method')->where([
            ['factures.number', $number],
            ['factures.user_id', Auth::id()],
        ])->leftJoin('transactions', 'factures.transaction_id', '=', 'transactions.id')->first();
        if($invoice) {
            $ecole = Ecole::where('identifiant_de_l_etablissement', Auth::user()->ecole_identifiant_de_l_etablissement)->first();
            $lignes = FactureLigne::where('facture_id', $invoice->id)
                ->leftJoin('produits', 'facture_lignes.produit_id', '=', 'produits.id')
                ->get();
                //dd($lignes);
            $pdf = PDF::loadView('pdf.facture', ['user' => Auth::user(), 'invoice' => $invoice, 'ecole' => $ecole, 'lignes' => $lignes]);
            return $pdf->stream('Facture_'.$invoice->number.'.pdf');
        }
    }

}
