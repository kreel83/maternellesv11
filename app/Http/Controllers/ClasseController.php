<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Configuration;
use App\Models\ClasseUser;
use Illuminate\Support\Facades\Auth;

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
        return view('classes.createclasse');
    }

    public function saveclasse(Request $request) {
        $classe = new Classe();
        $classe->ecole_identifiant_de_l_etablissement = $request->ecole;
        $classe->user_id = Auth::id();
        foreach ($request->section as $s) {
            $classe->$s = 1;
        }
        $classe->description = $request->description;
        $classe->save();
        $classeLink = new ClasseUser();
        $classeLink->user_id = Auth::id();
        $classeLink->classe_id = $classe->id;
        $classeLink->save();
        return redirect()->back()->withInput();
        
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
