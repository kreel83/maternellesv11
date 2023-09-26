<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserEmailVerificationFromAdmin;
use App\Mail\UserLicenceActiveeDepuisAdmin;
use App\Models\Ecole;
use App\Models\Facture;
use App\Models\FactureLigne;
use App\Models\Licence;
use App\Models\Produit;
use App\Models\Transaction;
use App\Models\User;
use App\utils\Utils;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Validator;
use Laravel\Cashier\Exceptions\InvalidPaymentMethod;
use Laravel\Cashier\Payment;
use Stripe\Exception\CardException;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Log;
use PDF;

class AdminLicenceController extends Controller
{
    
    /**
     * Affiche la liste des licences pour un Admin
     *
     * @return View
     */
    public function index(): View
    {
        $licences = Licence::listeDesLicencesPourUnAdmin();
        // Récupère le produit en vente en ce moment
        $product = Produit::produitEnCoursLicenceAdmin();
        /*
        // A VOIR : ne sert que si on veut des listes deroulantes de user dans le tableau des licences
        $users = User::select('id','name','prenom')
            ->where('ecole_id', Auth::user()->ecole_id)
            ->where('id','<>',Auth::id())
            ->whereNotIn('id', Licence::select('user_id')
                                    ->where('user_id','<>',null)
                                    ->where('parent_id',Auth::id())
                                    ->get()->toArray())
            ->get();
        */
        return view('admin.licence.index')
            //->with('users', $users)
            ->with('product', $product)
            ->with('licences', $licences);
    }

    /**
     * Affiche la page pour commander des licences utilisateur
     *
     * @return View
     */
    public function achat(): View
    {
        // Récupère le produit en vente en ce moment
        $product = Produit::produitEnCoursLicenceAdmin();
        $intent = auth()->user()->createSetupIntent();
        //dd($intent);
        return view('admin.licence.achat')
            ->with('product', $product)
            ->with('method', 'purchase')
            ->with('title', "Achats de licences pour mon établissement")
            ->with('quantity', '1')
            ->with('routeCardForm', route('admin.licence.create'))
            ->with('intent', $intent)
            ->with('licenceSelection', array());
    }

    /**
     * Affiche la page pour renouveller des licences utilisateur
     *
     * @param Request $request
     * @return View
     */
    public function renew(Request $request): View
    {
        $request->validate([
            'licenceSelection' => ['required'],
        ], [
            'licenceSelection.required' => 'Merci de sélectionner au moins une licence',
        ]);

        // Récupère le produit en vente maintenant
        $product = Produit::produitEnCoursLicenceAdmin();
        $intent = auth()->user()->createSetupIntent();
        return view('admin.licence.achat')
            ->with('product', $product)
            ->with('method', 'renew')
            ->with('title', "Renouvellement de licences")
            ->with('quantity', count($request->licenceSelection))
            ->with('routeCardForm', route('admin.licence.create'))
            ->with('intent', $intent)
            ->with('licenceSelection', $request->licenceSelection);
    }

    /**
     * Write code on Method
     *
     * @return view()
     */
    public function create(Request $request)
    {
        try {
            // création ou récupération du client
            $request->user()->createOrGetStripeCustomer();
            // récupération des éléments du produit actuel
            $product = Produit::find($request->product_id);
            // montant à charger * 100 pour envoyer à Stripe une valeur sans décimal
            $amount = ($request->quantity * $product->price) * 100;
            // on charge le client
            //$request->user()->invoicePrice('price_1NYAuHF73qwd826kwfu8ILFA', 1);
            $stripeCharge = $request->user()->charge(
                $amount, $request->payment_method, [
                    'metadata' => [
                        'user_id' => $request->user()->id,
                        'produit_id' => $product->id,
                        'method' => $request->method,
                        'price' => $product->price,
                        'quantity' => $request->quantity,
                        'expires_at' => $product->active_to,
                        'licenceSelection' => $request->licenceSelection,
                    ]
                ]
            );
            return view("admin.licence.result")
                ->with('result', $stripeCharge->status)
                ->with('method', $request->method);
        }  
        catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('admin.stripe.redirect', ['method' => $request->method])]
            );
        }
        catch (CardException $exception) {
            $json = $exception->getJsonBody();
            $message = $json['error']['message'].' ('.$json['error']['type'].')';
            return view("admin.licence.result")
                ->with('result', $message)
                ->with('request', $request->method);
        }
    }

    public function stripeRedirect($method, Request $request) {
        return view("admin.licence.result")
                ->with('result', $request->success)
                ->with('method', $method);
    }

    /*
    // anciennement utilisé si achat de licence par souscription stripe
    public function create(Request $request)
    {
        
        foreach (json_decode($request->licenceSelection) as $licence_id)
        {
            //$licence = new Licence;
            $licence = Licence::find($licence_id);
            $newExpirationDate = $licence->expires_at;
            dd($licence);
            //$licence->stripe_id = $stripe_id;
            //$licence->actif = 1;
            //$licence->expires_at = $expires_at; // avoir si on ajoute +1 an a la date actuelle

        }
        
        try {
            $internal_name = $this->getInternalName();
            $subscription = $request->user()->newSubscription($internal_name, 'price_1NEXRRF73qwd826kHYATzqgl')
                ->quantity($request->quantity)
                ->create($request->token);
            $expires_at = Auth::user()->subscription($internal_name)->asStripeSubscription()->current_period_end;
            $licence = new Licence;
            if($request->method == 'buy') {
                $licence->createUserLicence($request->quantity, $subscription->stripe_id, $expires_at);
            } elseif($request->method == 'renew') {
                $licence->renewUserLicence($request->quantity, $subscription->stripe_id, $expires_at, $request->licenceSelection);
            }
            return view("admin.subscription.result");
        } catch (IncompletePayment $exception) {
            return redirect()->route(
                'cashier.payment',
                [$exception->payment->id, 'redirect' => route('home')]  // A VOIR la route en cas d'echec de paiement
            );
        }
    }
    */

    public function assign(Request $request)
    {
        // verifier si compte user existe deja ! (OK)
        // verifier si pas deja une licence pour ce user !
        // verfifier validité de l'email
        // verifier si email a pas de . (OK)
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $is_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if($is_email) {
            $user = User::where('email', $email)->first();
            if(!$user) {
                // compte utilisateur inexistant, on le crée + envoi d'un email pour vérification
                // pré-remplissage nom + prénom d'après l'adresse email
                $prenomNom = Utils::getNameFromEmail($email);
                $token = md5(microtime(TRUE)*100000);
                $user = User::create([
                    'prenom' => $prenomNom['prenom'],
                    'name' => $prenomNom['nom'],
                    'email' => $email,
                    'ecole_identifiant_de_l_etablissement' => Auth::user()->ecole_identifiant_de_l_etablissement,
                    'validation_key' => $token,
                    'licence' => 'admin'
                ]);
                // Envoi d'un email de vérification
                $verificationLink = route('user.valideUserFromAdminCreatePassword', ['token' => $token]);
                //Log::info($verificationLink);
                Mail::to($email)->send(new UserEmailVerificationFromAdmin($verificationLink));
            } else {
                if($user->actif == 0) {
                    // compte user déjà crée mais non actif
                    // on envoi un email de rappel au user pour qu'il active son compte
                    Mail::to($email)->send(new UserEmailVerificationFromAdmin($user->validation_key));
                } else {
                    // compte user déjà crée et actif
                    // on envoi un email au user pour l'informer qu'une licence vient de lui être accordé
                    Mail::to($email)->send(new UserLicenceActiveeDepuisAdmin());
                }
                $user->licence = 'admin';
                $user->save();
            }
            $licence = new Licence;
            if($licence->assignLicenceToUser($request, $user->id)){
                return json_encode([
                    'result' => '1',
                    'msg' => 'Licence assignée !'
                ]);
            } else {
                return json_encode([
                    'result' => '0',
                    'msg' => 'Une licence est déjà active pour cet utilisateur !'
                ]);
            }
            //$licence->assignLicenceToUser($request, $newUser->id, $status);
            
        } else {
            return json_encode([
                'result' => '0',
                'msg' => 'Adresse email incorrecte !'
            ]);
        }  
    }

    public function confirmationRetraitLicence($id)
    {
        $licence = Licence::select('licences.id', 'licences.name as licenceName', 'users.name as nom', 'users.prenom as prenom')
            ->where('licences.id', $id)
            ->where('licences.parent_id', Auth::id())
            ->leftJoin('users', 'licences.user_id', '=', 'users.id')
            ->first();
        //$licence = Licence::find($id);
        //$user = User::find($licence->user_id);
        return view("admin.licence.remove")
            ->with('licence', $licence);
            //->with('user', $user);
    }

    
    public function retraitLicence(Request $request)
    {
        $licence = new Licence;
        $licence->removeLicenceToUser($request->id);
        return redirect()->route('admin.licence.index');
    }

    /**
     * Retourne la vue avec la liste des factures de l'admin
     *
     * @return View
     */
    public function invoice(): View
    {
        //$invoices = Auth::user()->invoices();
        $invoices = Facture::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view("admin.invoice")
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

    public function testinvoice($id)
    {
        //$invoices = Auth::user()->invoices();
        $invoices = Facture::where('id', $id)->first();
        return view("pdf.facture")
            ->with('invoices', $invoices);
    }
    
}