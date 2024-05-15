<?php

namespace App\Http\Controllers;

use App\Models\Ecole;
use App\Models\Facture;
use App\Models\FactureLigne;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoiceToSchool;
use Illuminate\View\View;

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

    /**
     * Affiche la liste des factures
     *
     * @return View
     */
    public function invoiceList(): View
    {
        $invoices = Facture::select('number', 'created_at', 'amount')->where('user_id', Auth::id())->orderByDesc('id')->get();
        return view("facture.list")
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
            return redirect()->route('facture.list')
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
            return redirect()->route('facture.list')
                ->with('status', 'success')
                ->with('msg', 'Votre facture n° '.$number.' a été envoyée à votre établissement.');
        } else {
            return redirect()->route('facture.list')
                ->with('status', 'danger')
                ->with('msg', 'Facture introuvable.');
        }
    }

}
