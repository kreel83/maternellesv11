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
use App\Models\Ecole;
use App\Models\Facture;
use App\Models\FactureLigne;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use PDF;

class SubscriptionController extends Controller
{
    public function index(): View
    {
        //$is_abonne = Auth::user()->is_abonne();
        $invoices = Facture::where('user_id', Auth::id())->count();
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
                $onGracePeriode = false;
                $message = "Licence numéro $licence->name gérée par votre établissement.";
                break;
            case 'self':
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
                $status = 'inactif';
                $expirationDate = null;
                $onGracePeriode = false;
                $message = "Aucun abonnement en cours.";
        }
        return view("subscription.index")
            //->with('is_abonne', $is_abonne)
            ->with('licenceType', $licenceType)
            ->with('invoices', $invoices)
            ->with('status', $status)
            ->with('expirationDate', $expirationDate)
            ->with('onGracePeriode', $onGracePeriode)
            //->with('cancelled', $cancelled)
            ->with('message', $message)
            ->with('msgIfCanceled', $msgIfCanceled);
    }

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
    } 

    public function stripeRedirect(Request $request) {
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
        //$invoices = Auth::user()->invoices();
        $invoices = Facture::where('user_id', Auth::id())->orderByDesc('id')->get();
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
                //dd($lignes);
            $pdf = PDF::loadView('pdf.facture', ['user' => Auth::user(), 'invoice' => $invoice, 'ecole' => $ecole, 'lignes' => $lignes]);
            return $pdf->stream('Facture_'.$invoice->number.'.pdf');
        }
    }

}
