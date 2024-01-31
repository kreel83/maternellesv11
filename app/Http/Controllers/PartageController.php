<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjoutePartageRequest;
use App\Mail\AcceptePartageDeClasse;
use App\Mail\DemandePartageClasseUserExistant;
use App\Mail\DemandePartageClasseUserInconnu;
use App\Mail\RefusePartageDeClasse;
use App\Models\Classe;
use App\Models\ClasseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isNull;

class PartageController extends Controller
{
    
    public function liste_partage() {
        $is_partage_en_cours = Auth::user()->check_is_partage_en_cours();
        return view('classes.partage')
            ->with('liste', $is_partage_en_cours);
    }

    public function agreeShare($id) {
        $partage = ClasseUser::find($id);
        $partage->user_id = Auth::id();
        $partage->save();
        // Envoi d'un mail au user à l'origine de la demande pour l'informer de l'acceptation
        $classe = Classe::find($partage->classe_id);
        $titulaire = User::find($classe->user_id);
        if($titulaire) {
            Mail::to($titulaire->email)
                ->send(new AcceptePartageDeClasse($titulaire->prenom, Auth::user()->name, Auth::user()->prenom));
        }
        if (!Auth()->user()->classe_id) {
            Auth()->user()->classe_id = $partage->classe_id;
            Auth::user()->save();
            $classe = Classe::find($partage->classe_id);
            session(['classe_active' => $classe ]);        
        }
        session(['autres_classes' => Auth::user()->autresClasses()]);       
        return 'done';
    }

    public function rejectShare($id) {
        $partage = ClasseUser::find($id);
        // Envoi d'un mail au user à l'origine de la demande pour l'informer du refus
        $classe = Classe::find($partage->classe_id);
        $titulaire = User::find($classe->user_id);
        if($titulaire) {
            Mail::to($titulaire->email)
                ->send(new RefusePartageDeClasse($titulaire->prenom));
        }
        $partage->delete();
        return 'done';
    }

    public function index() {
        $partages = ClasseUser::select('classe_users.id', 'classe_users.role', 'users.name', 'users.prenom')        
            ->where('classe_users.classe_id', session('classe_active')->id)
            ->rightJoin('users', 'users.id', '=', 'classe_users.user_id')
            ->get();
        $pendings = ClasseUser::select('classe_users.id', 'classe_users.email', 'classe_users.role', 'users.name', 'users.prenom')
            ->where('classe_users.classe_id', session('classe_active')->id)
            ->where('classe_users.user_id', null)
            ->leftJoin('users', 'users.email', '=', 'classe_users.email')
            ->get();
        return view('partage.index')
            ->with('pendings', $pendings)
            ->with('partages', $partages);
    }

    public function ajoutePartage(AjoutePartageRequest $request) {
        // test pour savoir si la classe est déjà partagée avec cet utilisateur
        $partage = ClasseUser::where('classe_id', session('classe_active')->id)
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
            ->with('role', $request->role)
            ->with('valueForSubmitBtn', $valueForSubmitBtn)
            ->with('newUser', $newUser);
    }

    public function sendMailPartage(Request $request) {
        $token = md5(microtime(TRUE)*100000);
        $verificationLink = route('acceptePartage', ['token' => $token]);
        $nomDemandeur = $request->user()->prenom.' '.$request->user()->name;
        $prenom = $request->prenom;
        // enregistrement du partage sans user_id qui sera complété à l'acceptation par le user
        $partage = new ClasseUser();
        $partage->classe_id = Auth::user()->classe_id;
        $partage->token = $token;
        $partage->email = $request->email;
        $partage->role = $request->role;
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
        $token = md5($classeuser_id.config('app.custom.hash_secret'));
        if($token != $request->token) {
            return redirect()->route('partager')
                ->with('status', 'danger')
                ->with('msg', 'Erreur de Token');
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
        $token = md5($request->classeuser_id.config('app.custom.hash_secret'));
        if($token != $request->token) {
            return redirect()->route('partager')
            ->with('status', 'danger')
            ->with('msg', 'Erreur de Token');
        }
        $partage = ClasseUser::find($request->classeuser_id);
        // on recupere le user pour voir quelle est sa classe par defaut 
        $user = User::find($partage->user_id);
        if($user) {
            // Si cette classe est la dernière classe ouverte par le user : 
            if($user->classe_id == $partage->classe_id) {
                // le user est-il titulaire d'une classe ?
                $existingClasse = Classe::where('user_id', $user->id)->first();
                if($existingClasse) {
                    // si oui on lui met par défaut
                    $user->classe_id = $existingClasse->id;
                } else {
                    // si non, a t'il un autre partage de classe
                    $autrePartage = ClasseUser::where('user_id', $user->id)
                        ->where('classe_id', '<>', $partage->classe_id)
                        ->first();
                    // si oui on lui met par défaut sinon null
                    $user->classe_id = $autrePartage ? $autrePartage->classe_id : null;
                }
                $user->save();
            }
        }
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
                // si le user n'a pas encore de classe active, on lui met la classe partagée comme active
                if(isNull($user->classe_id)) {
                    $user->classe_id = $partage->classe_id;
                    $user->save();
                }
                // Envoi d'un mail au user à l'origine de la demande pour l'informer de l'acceptation
                if($titulaire) {
                    Mail::to($titulaire->email)->send(new AcceptePartageDeClasse($titulaire->prenom, $user->name, $user->prenom));
                }
                $acceptePartage = true;
            }
        }
        return view('partage.acceptePartage')
            ->with('nomTitulaire', $nomTitulaire ?? '')
            ->with('acceptePartage', $acceptePartage ?? false);
    }

}
