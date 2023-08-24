<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Configuration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GroupeController extends Controller
{
    public function index() {
        $type = Auth::user()->type_groupe;
        $groupes = Auth::user()->groupes;
        $nbGroupe = 2;           
        if ($groupes) {
         $groupes = json_decode($groupes, true);
        $nbGroupe = sizeof($groupes);           
        }

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

        $config = Configuration::where('user_id', $user)->first();
        if (!$config) {
            $config = new Configuration();
            $config->user_id = $user;            
        }

        $config->groupes = join('/', $n);
        $config->save();
        return 'ok';
    }

    public function saveTermes(Request $request) {
        $arr = array();
        for ($i = 0; $i<$request->nbGroupe; $i++) {
            $arr[$i]['name'] = $request->termes[$i];
            $arr[$i]['backgroundColor'] = $request->back[$i];
            $arr[$i]['textColor'] = $request->font[$i];
        }

        

        $user = Auth::user();


        $config = Configuration::where('user_id', $user->id)->first();
        if (!$config) {
            $config = new Configuration();
            $config->user_id = $user->id;            
        }

        $config->groupes = json_encode($arr);
        $config->save();
        return Redirect::back();


    }
}
