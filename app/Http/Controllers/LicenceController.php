<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
use App\Models\Facture;
use App\Models\FactureLigne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoiceToSchool;
use App\Models\Licence;
use App\Models\Produit;

class LicenceController extends Controller
{
    
    public function index(Request $request): View
    {
        return view('licence.index')
        ->with('checkout', $request->checkout ?? null);  // retour de stripe checkout
    }

    public function detail(Request $request): View
    {
        $licenceType = Auth::user()->licence;
        $msgIfCanceled = "";
        switch($licenceType) {
            case 'admin':
                $type = 'Abonnement annuel';
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
                $type = 'Abonnement annuel';
                $status = Auth::user()->subscribed('default') ? 'actif' : 'expiré';
                $expirationDate = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
                $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
                $message = "Licence gérée par vous-même.";
                $cancelled = Auth::user()->subscription('default')->canceled();
                if($cancelled) {
                    $msgIfCanceled = "Vous avez résilié votre abonnement.";
                }
                break;
            case 'lifetime':
                $type = 'Nominative à vie';
                $status = 'actif';
                break;
        }
        return view("licence.detail")
            ->with('checkout', $request->checkout ?? null)  // retour de stripe checkout
            ->with('licenceType', $licenceType)
            ->with('type', $type)
            ->with('status', $status)
            ->with('expirationDate', $expirationDate ?? null)
            ->with('onGracePeriode', $onGracePeriode ?? false)
            ->with('message', $message ?? '')
            ->with('msgIfCanceled', $msgIfCanceled);
    }

}
