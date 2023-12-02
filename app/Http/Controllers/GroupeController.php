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
        $groupes = Auth::user()->configuration->groupes;
        if ($groupes) {
            $groupes = json_decode($groupes, true);
            $nbGroupe = sizeof($groupes);
        } else {
            $nbGroupe = 0;
        }
        $ct = Enfant::where('user_id', Auth::id())->whereNotNull('groupe')->count();

        return view('groupes.index')
            ->with('ct', $ct)
            ->with('nbGroupe', $nbGroupe)
            ->with('groupes', $groupes ?? []);
    }
    // public function index() {
    //     $type = Auth::user()->type_groupe;
    //     $groupes = Auth::user()->configuration->groupes;
    //     $nbGroupe = 2;           
       
    //     if ($groupes) {
    //         $groupes = json_decode($groupes, true);
    //         $nbGroupe = sizeof($groupes);           
    //     }

    //     return view('groupes.index')
    //         ->with('nbGroupe', $nbGroupe)
    //         ->with('groupes', $groupes);
    // }

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
        for ($i = 0; $i < $request->nbGroupe; $i++) {
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

        session()->flash('success','Les groupes ont bien été enregistrés');
        return redirect()->back();


    }

    public function editerUnGroupe($id, Request $request) {
        $token = md5(Auth::id().$id.env('HASH_SECRET'));
        if($token != $request->token) {
            return redirect()->route('groupe')
                ->with('status', 'danger')
                ->with('msg', 'Token invalide.');
        }
        $groupes = Auth::user()->configuration->groupes;
        if ($groupes) {
            $groupes = json_decode($groupes, true);          
        } else {
            $groupes = array();
        }
        return view('groupes.edit')
            ->with('token', $token)
            ->with('groupes', $groupes)
            ->with('id', $id);
    }

    public function editerUnGroupePost(Request $request) {
        $token = md5(Auth::id().$request->id.env('HASH_SECRET'));
        if($token != $request->token) {
            return redirect()->route('groupe')
                ->with('status', 'danger')
                ->with('msg', 'Token invalide.');
        }

        $request->validate([
            'groupName' => ['string', 'max:12', 'nullable'],
        ], [
            'groupName.required' => 'Le nom est obligatoire.',
            'groupName.max' => 'Le nom est limité à 12 caractères.',
        ]);

        $groupes = Auth::user()->configuration->groupes;
        if ($groupes) {
            $groupes = json_decode($groupes, true);          
        } else {
            $groupes = array();
        }
        if($request->id == 'new') {
            $groupes[] = array(
                'name' => $request->groupName,
                'backgroundColor' => $request->groupBackgroundColor,
                'textColor' => $request->groupTextColor
            );
        } else {
            $groupes[$request->id]['name'] = $request->groupName;
            $groupes[$request->id]['backgroundColor'] = $request->groupBackgroundColor;
            $groupes[$request->id]['textColor'] = $request->groupTextColor;
        }
        //$groupes[] = $newGroup;
        //dd($groupes);
        $config = Configuration::where('user_id', Auth::id())->first();
        if (!$config) {
            $config = new Configuration();
            $config->user_id = Auth::id();            
        }        
        $config->groupes = json_encode($groupes);
        $config->save();

        session()->flash('success','Les groupes ont bien été enregistrés');
        return redirect()->route('groupe');

        // [{"name":"dfgfdg","backgroundColor":"#B71C1C","textColor":"#FFFFFF"},{"name":"dfgfdg","backgroundColor":"#311B92","textColor":"#FFFFFF"},{"name":"dfgfd","backgroundColor":"#009688","textColor":"#FFFFFF"},{"name":"hhjjghjg","backgroundColor":"#F44336","textColor":"#FFFFFF"}]
    }

    public function supprimerUnGroupe($id, Request $request) {

        $token = md5(Auth::id().$id.env('HASH_SECRET'));        

        
        $groupes = Auth::user()->configuration->groupes;


        $groupes = json_decode($groupes, true); 
        
        unset($groupes[$id -1]);
        
        $nbGroupe = sizeof($groupes) ?? 0;
        $config = Configuration::where('user_id', Auth::id())->first();
        if (!$config) {
            $config = new Configuration();
            $config->user_id = Auth::id();            
        }   

        $config->groupes = json_encode(array_values($groupes));        
        $config->save();

        Enfant::where('user_id', Auth::id())->where('groupe', $id-1 )->update(
            ['groupe' => null]
        );


       


        return redirect()->route('groupe')->with('groupes', $groupes)->with('nbGroupe', $nbGroupe);
    }



}
