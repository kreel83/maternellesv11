<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationResumeSubscription;
use App\Mail\SendInvoiceToSchool;
use App\Models\Ecole;
use App\Models\Facture;
use App\Models\FactureLigne;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use PDF;

class SubscriptionController extends Controller
{
    public function index(Request $request): View
    {
        $invoices = Facture::where('user_id', Auth::id())->count();
        $licenceType = Auth::user()->licence;
        $msgIfCanceled = "";
        switch($licenceType) {
            case 'admin':
                $produit = null;
                $licence = Licence::where([
                    ['user_id', Auth::user()->id],
                    ['actif', 1],
                ])->first();                
                $status = $licence ? 'actif' : 'expiré';
                if($licence) {
                    $expirationDate = $licence->expires_at;
                    $onGracePeriode = false;
                    $message = "Licence n° $licence->name gérée par votre établissement.";
                }
                break;
            case 'self':
                $produit = null;
                $status = Auth::user()->subscribed('default') ? 'actif' : 'expiré';
                $expirationDate = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
                $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
                $message = "Licence gérée par vous-même.";
                $cancelled = Auth::user()->subscription('default')->canceled();
                if($cancelled) {
                    $msgIfCanceled = "Vous avez résilié votre abonnement.";
                }
                break;
            default:
                $produit = Produit::produitAbonnementUser();
                $status = 'inactif';
                $expirationDate = null;
                $onGracePeriode = false;
                $message = "Aucun abonnement en cours.";
        }
        return view("subscription.index")
            ->with('checkout', $request->checkout)  // retour de stripe checkout
            ->with('produit', $produit)
            ->with('licenceType', $licenceType)
            ->with('invoices', $invoices)
            ->with('status', $status)
            ->with('expirationDate', $expirationDate ?? null)
            ->with('onGracePeriode', $onGracePeriode ?? false)
            ->with('message', $message ?? '')
            ->with('msgIfCanceled', $msgIfCanceled);
    }

    public function cardform(): View
    {
        $product = Produit::produitAbonnementUser();
        $intent = auth()->user()->createSetupIntent();
        return view('subscription.cardform', compact("intent","product"));
    }

    public function subscribe(Request $request)
    {
        $product = Produit::produitAbonnementUser();
        try {
            $request->user()->newSubscription('default', $product->stripe_product_id)
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
                return redirect()->route('subscribe.waiting');
            // return redirect()->route('depart')
            //     ->with('status', 'success')
            //     ->with('msg', 'Merci ! Vous êtes maintenant abonné(e) au service '.config('app.name').' pour 1 an.');
            // return view("subscription.result")
            //     ->with('result', 'succeeded');
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
            return redirect()->route('depart')
                ->with('status', 'danger')
                ->with('msg', $message);
            // return view("subscription.result")
            //     ->with('result', $message);
        }
    } 

    public function stripeRedirect(Request $request) {
        if($request->success) {
            return redirect()->route('subscribe.waiting');
        } else {
            return redirect()->route('depart')
                ->with('status', 'danger')
                ->with('msg', 'Une erreur est survenue.');
        }
        // if($request->success) {
        //     $status = 'success';
        //     $msg = 'Merci ! Vous êtes maintenant abonné(e) au service '.config('app.name').' pour 1 an.';
        // } else {
        //     $status = 'danger';
        //     $msg = 'Une erreur est survenue.';
        // }
        // return redirect()->route('depart')
        //         ->with('status', $status)
        //         ->with('msg', $msg);
        // return view("subscription.result")
        //         ->with('result', $request->success);
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
        $invoices = Facture::select('number', 'created_at', 'amount')->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view("subscription.invoice")
            ->with('invoices', $invoices);
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
            $pdf = PDF::loadView('pdf.facture', [
                'user' => Auth::user(),
                'invoice' => $invoice,
                'ecole' => $ecole,
                'lignes' => $lignes
            ]);
            $pdf->add_info('Title', 'Facture n° '.ucfirst($invoice->number));
            return $pdf->stream('Facture_'.$invoice->number.'.pdf');
        } else {
            return redirect()->route('subscribe.invoice')
                ->with('status', 'danger')
                ->with('msg', 'Facture introuvable.');
        }
    }

    public function sendInvoice($number)
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
            $pdf = PDF::loadView('pdf.facture', ['user' => Auth::user(), 'invoice' => $invoice, 'ecole' => $ecole, 'lignes' => $lignes]);
            Mail::to($ecole->mail)->send(new SendInvoiceToSchool($pdf->output(),'Facture_'.$invoice->number.'.pdf'));
            return redirect()->route('subscribe.invoice')
                ->with('status', 'success')
                ->with('msg', 'Votre facture n° '.$number.' a été envoyée à votre établissement.');
        } else {
            return redirect()->route('subscribe.invoice')
                ->with('status', 'danger')
                ->with('msg', 'Facture introuvable.');
        }
    }

    public function subscribeWithStripeCheckout(Request $request)
    {
        // https://stripe.com/docs/api/checkout/sessions/create
        $product = Produit::produitAbonnementUser();
        return $request->user()->newSubscription('default', $product->stripe_product_id)
            ->checkout([
                'success_url' => route('subscribe.waiting'),
                'cancel_url' => route('subscribe.index', ['checkout' => 'cancel']),
                'subscription_data' => [
                    'metadata' => [
                        'user_id' => $request->user()->id,
                        'produit_id' => $product->id,
                        'method' => 'subscription',
                        'price' => $product->price,
                        'quantity' => 1,
                        'amount' => $product->price,
                    ]
                ]
            ]);
    } 

    public function stripeAttenteFinalisation(Request $request) {
        if(Auth::user()->subscribed('default')) {
            session(['is_abonne' => true]);
            return redirect()->route('depart')
            ->with('status', 'success')
            ->with('msg', 'Merci ! Vous êtes maintenant abonné(e) au service '.config('app.name').' pour 1 an.');
        } else {
            return view("subscription.waiting");
        }
    }

}
