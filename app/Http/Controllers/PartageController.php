<?php

namespace App\Http\Controllers;

use App\Mail\DemandePartageClasseUserExistant;
use App\Mail\DemandePartageClasseUserInconnu;
use App\Mail\envoiCodeSecuritePartage;
use App\Models\Classe;
use App\Models\ClasseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PartageController extends Controller
{
    
    public function index(Request $request) {
        $partages = ClasseUser::select('classe_users.id', 'classe_users.code', 'users.name', 'users.prenom')
            ->where('classe_users.classe_id', $request->user()->maClasse()->id)
            ->rightJoin('users', 'users.id', '=', 'classe_users.user_id')
            ->get();
        $pendings = ClasseUser::select('classe_users.id', 'classe_users.email', 'users.name', 'users.prenom')
            ->where('classe_users.classe_id', $request->user()->maClasse()->id)
            ->where('classe_users.user_id', null)
            ->leftJoin('users', 'users.email', '=', 'classe_users.email')
            ->get();
        return view('partage.index')
            ->with('pendings', $pendings)
            ->with('partages', $partages);
    }

    public function ajoutePartage(Request $request) {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'code' => ['required', 'integer', 'digits:6'],
        ], [
            'email.required' => 'Adresse mail obligatoire.',
            'email.max' => 'Adresse mail limitée à 255 caractères.',
            'email.email' => 'Adresse mail incorrecte.',
            'code.required' => 'Code de sécurité obligatoire.',
            'code.integer' => 'Le code de sécurité doit être composé de 6 chiffres.',
            'code.digits' => 'Le code de sécurité doit être composé de 6 chiffres.',
        ]);

        // test pour savoir si la calsse est déjà partagée avec cet utilisateur
        $partage = ClasseUser::where('classe_id', $request->user()->maClasse()->id)
            ->where('email', $request->email)
            ->first();
        if($partage) {
            return redirect()->route('partager')
            ->with('status', 'warning')
            ->with('msg', 'La classe est déjà partagée avec cet utilisateur.');
        }

        $newUser = User::where('email', $request->email)->first();
        $valueForSubmitBtn = ($newUser) ? 'exist' : 'new';
        return view('partage.confirmAjout')
            ->with('email', $request->email)
            ->with('code', $request->code)
            ->with('valueForSubmitBtn', $valueForSubmitBtn)
            ->with('newUser', $newUser);
    }

    public function sendMailPartage(Request $request) {
        $token = md5(microtime(TRUE)*100000);
        $verificationLink = route('acceptePartage', ['token' => $token]);
        $nomDemandeur = $request->user()->prenom.' '.$request->user()->name;
        $prenom = $request->prenom;
        //$user = User::where('email', $request->email)->first();
        // enregistrement du partage sans user_id qui sera complété à l'acceptation par le user
        $partage = new ClasseUser;
        $partage->classe_id = 1;        // ****************  A CHANGER *************************
        $partage->token = $token;
        $partage->email = $request->email;
        $partage->code = $request->code;
        $partage->save();
        // Envoi d'un email au user
        if($request->btnsubmit == 'exist') {
            // Compte existant
            Mail::to($request->email)->send(new DemandePartageClasseUserExistant($nomDemandeur, $prenom, $verificationLink));
        } else {
            // Compte inexistant
            Mail::to($request->email)->send(new DemandePartageClasseUserInconnu($nomDemandeur, $verificationLink));
        }
        return redirect()->route('partager')
            ->with('status', 'success')
            ->with('msg', 'Un courrier électronique a été envoyé à : '.$request->email);
    }

    public function supprimePartage($classeuser_id, Request $request) {
        $token = md5($classeuser_id.env('HASH_SECRET'));
        if($token != $request->token) {
            return redirect()->route('partager')
            ->with('status', 'danger')
            ->with('msg', 'Token error');
        }
        $partage = ClasseUser::find($classeuser_id);
        $user = User::find($partage->user_id);
        if($user) {
            $nomDemandeur = $user->prenom.' '.$user->name.' ('.$user->email.')';
        } else {
            $nomDemandeur = $partage->email;
        }
        return view('partage.supprimePartage')
            ->with('token', $token)
            ->with('classeuser_id', $classeuser_id)
            ->with('nomDemandeur', $nomDemandeur)
            ->with('partage', $partage)
            ->with('user', $user);
    }

    public function supprimePartageFinal(Request $request) {
        $token = md5($request->classeuser_id.env('HASH_SECRET'));
        if($token != $request->token) {
            return redirect()->route('partager')
            ->with('status', 'danger')
            ->with('msg', 'Token error');
        }
        $partage = ClasseUser::find($request->classeuser_id);
        $partage->delete();
        return redirect()->route('partager')
            ->with('status', 'success')
            ->with('msg', 'Le partage de la classe avec '.$request->nomDemandeur.' a été supprimé');
    }

    public function acceptePartage($token) {
        // Cette fonction valide un partage seulement pour les users ayant déjà un compte
        // Pour les inconnus, la validation se fait à la vérification de la création du compte (lien dans email)
        $partage = ClasseUser::where('token', $token)->first();
        if($partage) {
            $user = User::where('email', $partage->email)->first();
            if($user) {
                $classe = Classe::find($partage->classe_id);
                $titulaire = User::find($classe->user_id);
                $nomTitulaire = $titulaire->prenom.' '.$titulaire->name;
                $partage->user_id = $user->id;
                $partage->save();
                $acceptePartage = true;
            }
        }
        return view('partage.acceptePartage')
            ->with('nomTitulaire', $nomTitulaire ?? '')
            ->with('acceptePartage', $acceptePartage ?? false);
    }

    public function sendCodePartage($classeuser_id, Request $request) {
        $token = md5($classeuser_id.env('HASH_SECRET'));
        if($token != $request->token) {
            return redirect()->route('partager')
            ->with('status', 'danger')
            ->with('msg', 'Token error');
        }
        $partage = ClasseUser::find($classeuser_id);
        $user = User::find($partage->user_id);
        $nomDemandeur = $user->prenom.' '.$user->name;
        //Mail::to('contact.clickweb@gmail.com')->send(new envoiCodeSecuritePartage($partage->code, $nomDemandeur));
        Mail::to(Auth::user()->email)->send(new envoiCodeSecuritePartage($partage->code, $nomDemandeur));
        return redirect()->route('partager')
            ->with('status', 'success')
            ->with('msg', 'Vous allez recevoir un courrier électronique avec votre code de sécurité.');
    }

}
