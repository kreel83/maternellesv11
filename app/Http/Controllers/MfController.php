<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscriptionALaNewsletter;
use App\Mail\DemandeDeContactSitePublic;
use App\Models\Contact;
use App\Models\Ecole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MfController extends Controller
{
    public function index() {
        return view('mf.index');
    }

    public function contact() {
        return view('mf.contact');
    }

    public function application() {
        return view('mf.application');
    }

    public function compagnon() {
        return view('mf.compagnon');
    }

    public function tarifs() {
        return view('mf.tarifs');
    }

    public function mentions() {
        return view('mf.mentions');
    }

    public function confidentialite() {
        return view('mf.confidentialite');
    }

    public function cookies() {
        return view('mf.cookies');
    }

    public function conditions() {
        return view('mf.conditions');
    }

    public function etablissement() {
        return view('mf.etablissement');
    }

    public function newsletter(InscriptionALaNewsletter $request) {

        return view('mf.newsletter');
    }

    public function searchSchool(Request $request) {
        $ecoles = Ecole::orWhere(function($query) use ($request) {
                $query->where('identifiant_de_l_etablissement', $request->search)
                      ->orWhere('code_postal', $request->search)
                      ->orWhere('nom_etablissement', 'LIKE', '%' . $request->search .'%')
                      ->orWhere('nom_commune', 'LIKE', '%' . $request->search .'%');
            })
            ->where('identifiant_de_l_etablissement', '<>', '9999999Z')    
            ->orderBy('code_academie')
            ->orderBy('code_postal')        
            ->get();
        $str = 'Etablissements trouvés : '.$ecoles->count().'<br/>';
        $academie = '';
        foreach ($ecoles as $ecole) {
            // $str .= $ecole->identifiant_de_l_etablissement.' - '.$ecole->nom_etablissement.' ('.$ecole->adresse_1.' '.$ecole->adresse_3.')'.'<br/>';
            if($academie != $ecole->libelle_academie) {
                $str .= '<h5>Académie de '.$ecole->libelle_academie.'</h5>';
                $academie = $ecole->libelle_academie;
            }
            $str .= $ecole->nom_etablissement.', '.$ecole->adresse_1.', '.$ecole->adresse_3.' - ('.$ecole->identifiant_de_l_etablissement.')'.'<br/>';
        }
        $result = array();
        $result['liste'] = $str;
        return json_encode($result);
    }

    public function contactSend(Request $request) {

        $request->validate([
            'name' => ['nullable','string', 'max:255'],
            'phone' => ['nullable','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ], [
            'email.required' => 'Adresse mail obligatoire.',
            'email.max' => 'Adresse mail limitée à 255 caractères.',
            'subject.required' => 'L\'objet du message est obligatoire.',
            'subject.max' => 'L\'objet du message est limité à 255 caractères.',
            'message.required' => 'Le message est obligatoire.',
        ]);

        Contact::create([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        $to = explode(',', config('app.custom.admin_emails'));
        Mail::to($to)->send(new DemandeDeContactSitePublic($request->subject, $request->message, $request->phone, $request->name, $request->email));

        return view('mf.contact-sent');

    }

}
