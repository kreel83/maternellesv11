<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GroupeController extends Controller
{
    public function index() {
        $type = Auth::user()->type_groupe;
        $groupes = Auth::user()->groupes;
        $groupes = json_decode($groupes, true);
        $nbGroupe = sizeof($groupes);


        
        
        return view('groupes.index')
            ->with('nbGroupe', $nbGroupe)
            ->with('groupes', $groupes);
    }

    public function affectation_groupe() {
        $eleves = Auth::user()->liste();
        
        $groupes = json_decode(Auth::user()->groupes, true);
        
        return view('groupes.affectation_groupe')
            ->with('eleves', $eleves)
            ->with('groupes', $groupes)
            ->with('user', Auth::user());
    }

    public function affectation(Request $request) {
        $enfant = Enfant::find($request->eleve);
        $enfant->groupe = $request->order;
        $enfant->save();
        return 'ok';
    }

    public function saveColor(Request $request) {
        $user = Auth::user();

        $liste = json_decode($request->tableau);
       
        $coll = new Collection($liste);
        $n = $coll->sortBy('order')->pluck('color')->toArray();
        $user->groupes = join('/', $n);
        $user->save();
        return 'ok';
    }

    public function saveTermes(Request $request) {
        $arr = array();
        for ($i = 0; $i<$request->nbGroupe; $i++) {
            $arr[$i][] = $request->termes[$i];
            $arr[$i][] = $request->back[$i];
            $arr[$i][] = $request->font[$i];
        }
        

        $user = Auth::user();



        $user->groupes = $arr;
        $user->save();

        return Redirect::back();
    }
}
