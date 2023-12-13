<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Configuration;
use App\Models\ClasseUser;
use App\Models\Ecole;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ClasseController extends Controller
{
    public function changerclasse(Request $request) {
        $classe = Classe::find($request->classe);
        $user = Auth::user();
        $user->classe_id = $request->classe;
        $user->save();
        session(['id_de_la_classe' => $classe->id]);
        session(['nom_de_la_classe' => $classe->description]);

        return redirect()->route('depart');
    }

    public function createclasse() {
        return view('classes.createclasse')
            ->with('title', 'Création de ma classe');
    }


    public function updateclasse() {
        $classe = Classe::find(session('id_de_la_classe'));
        return view('classes.createclasse')
            ->with('title', 'Modification de ma classe')            
            ->with('classe', $classe);
    }

    public function confirmeClasse(Request $request) {
        $request->validate([
            'ecole_id' => ['required', 'max:8', 'min:8', 'exists:ecoles,identifiant_de_l_etablissement'],
            'description' => ['required', 'string'],
        ], [
            'ecole_id.required' => 'Veuillez indiquer l\'identifiant de votre établissement.',
            'ecole_id.min' => 'L\'identifiant de l\'établissement doit avoir 8 caractères minimum.',
            'ecole_id.max' => 'L\'identifiant de l\'établissement doit avoir 8 caractères maximum.',
            'ecole_id.exists' => 'L\'identifiant de votre établissement est introuvable. Vérifiez votre saisie.',
            'description.required' => 'Veuillez donner un nom à votre classe.',
        ]);

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
        return view('classes.confirmeCreation')
            ->with('classe_id', $request->classe_id)
            ->with('title', $request->classe_id == 'new' ? 'Création de ma classe' : 'Modification de ma classe')
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

        $classe->user_id = Auth::id();

        $section = json_decode($request->section, true);
        if($request->classe_id == 'new') {
            if(isset($section)) {
                foreach ($section as $s) {
                    $classe->$s = 1;
                }
            }
        } else {
            //$classe->id = $request->classe_id;
            $classe->ps = in_array('ps', $section) ? 1 : 0;
            $classe->ms = in_array('ms', $section) ? 1 : 0;
            $classe->gs = in_array('gs', $section) ? 1 : 0;
        }

        $classe->description = $request->description;
        $classe->save();


        // if($request->classe_id == 'new') {
        //     $classe->save();
        // } else {
        //     $classe->id = $request->classe_id;
        //     $classe->update();
        // }

        // // enregistrement aussi dans la table de relations - désactivé
        // $classeLink = new ClasseUser();
        // $classeLink->user_id = Auth::id();
        // $classeLink->classe_id = $classe->id;
        // $classeLink->save();

        return view('classes.succesCreation')
            ->with('classe_id', $request->classe_id)
            ->with('title', $request->classe_id == 'new' ? 'Création de ma classe' : 'Modification de ma classe')
            ->with('description', $request->description);        

    }

    public function modifyclasse(Request $request) {
        $classe = Classe::find($request->id);
        foreach ($request->section as $s) {
            $classe->$s = 1;
        }
        $classe->description = $request->description;
        $classe->save();
        return redirect()->back()->withInput();        
    }
}
