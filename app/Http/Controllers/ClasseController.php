<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmeClasseRequest;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Ecole;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{

    public function changerclasse(Request $request) {
        // vérification du token de sécurité initialisé dans le menu
        $token = md5(Auth::id().$request->classe.config('app.custom.hash_secret'));
        if($token != $request->token) {
            return redirect()->route('error')->with('msg', 'Token incorrect.');
        }
        
        $classe = Classe::find($request->classe);
        $user = Auth::user();
        $user->classe_id = $request->classe;
        $user->save();

        session(['classe_active' => $classe]);
        session(['is_enfants' => $classe->is_enfants()]);
        session(['autres_classes' => Auth::user()->autresClasses()]);
        return redirect()->route('depart');
    }

    public function createclasse() {
        return view('classes.createclasse')
            ->with('title', 'Création de ma classe');
    }

    public function updateclasse() {
        // $classe = Classe::find(session('id_de_la_classe'));
        //$classe = session('classe_active');
        if(Auth::id() != session('classe_active')->user_id) {
            return redirect()->route('error')->with('msg', 'Vous n\'avez pas les droits pour modifier cette classe.');
        }
        $direction = json_decode(session('classe_active')->direction, true);
        return view('classes.createclasse')
            ->with('title', 'Modification de ma classe')
            ->with('direction', $direction)
            ->with('classe', session('classe_active'));

    }

    public function confirmeClasse(ConfirmeClasseRequest $request) {
        $ecole = Ecole::where('identifiant_de_l_etablissement', $request->ecole_id)->first();
        if(isset($request->section)) {
            $sections = array('ps' => 'Petite section', 'ms' => 'Moyenne section', 'gs' => 'Grande section');
            $sec = array();
            foreach($request->section as $value) {
                $sec[] = $sections[$value];
            }
            $sectionTexte = implode(' / ', $sec);
        } else {
            $sectionTexte = 'aucune section définie.';
        }
        $direction = json_encode(
            array('civilite' => $request->civilite, 'prenom' => ucfirst($request->prenom), 'nom' => strtoupper($request->nom))
        );
        return view('classes.confirmeCreation')
            ->with('classe_id', $request->classe_id)
            ->with('title', $request->classe_id == 'new' ? 'Création de ma classe' : 'Modification de ma classe')
            ->with('direction', $direction)
            ->with('description', $request->description)
            ->with('sectionTexte', $sectionTexte)
            ->with('section', json_encode($request->section))
            ->with('ecole', $ecole);
    }

    public function saveclasse(Request $request) {
        if($request->classe_id == 'new') {
            $classe = new Classe();
        } else {
            $classe = Classe::find($request->classe_id);
        }
        $classe->ecole_identifiant_de_l_etablissement = $request->ecole_id;
        $classe->ecole_code_academie = $request->code_academie;

        $classe->user_id = Auth::id();

        $section = json_decode($request->section, true);
        if($request->classe_id == 'new') {
            if(isset($section)) {
                foreach ($section as $s) {
                    $classe->$s = 1;
                }
            }
        } else {
            if(isset($section)) {
                $classe->ps = in_array('ps', $section) ? 1 : 0;
                $classe->ms = in_array('ms', $section) ? 1 : 0;
                $classe->gs = in_array('gs', $section) ? 1 : 0;
            }
        }
        
        $classe->description = $request->description;
        $classe->direction = $request->direction;
        $classe->save();

        $is_classeActive = session()->has('classe_active');

        if(!$is_classeActive) {
            // si le user n'a pas de classe active on lui active la nouvelle classe d'office
            $user = Auth::user();
            $user->classe_id = $classe->id;
            $user->save();
            session(['classe_active' => $classe]);
        }

        session(['autres_classes' => Auth::user()->autresClasses()]);

        if($request->classe_id == 'new') {
            if(!$is_classeActive) {
                $msg = 'Félicitations ! vous avez crée et activé la classe : '.$request->description;
            } else {
                $msg = 'Félicitations ! vous avez crée la classe : '.$request->description.'. ';
                $msg .= 'Si vous voulez basculer sur cette nouvelle classe, <a href="'.route('changerClasse',['classe' => $classe->id]).'" class="alert-link">cliquez ici.</a>';
            }
        } else {
            $msg = 'Félicitations ! les modifications ont bien été sauvegardées pour la classe : '.$request->description;
        }
        return redirect()->route('depart')
            ->with('status', 'success')
            ->with('msg', $msg);
    }

}
