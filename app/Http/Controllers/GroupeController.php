<?php
namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupeController extends Controller
{
    public function index() {
        $groupes = Auth::user()->groupes();
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
        // $classe = Classe::find(session()->get('id_de_la_classe'));
        $classe = Classe::find(session('classe_active')->id);

        $liste = json_decode($request->tableau);
       
        $coll = new Collection($liste);
        $n = $coll->sortBy('order')->pluck('color')->toArray();

        $classe->groupes = join('/', $n);
        $classe->save();
        return 'ok';
    }

    public function saveTermes(Request $request) {
        $arr = array();
        for ($i = 0; $i < $request->nbGroupe; $i++) {
            $arr[$i]['name'] = $request->termes[$i];
            $arr[$i]['backgroundColor'] = $request->back[$i];
            $arr[$i]['textColor'] = $request->font[$i];
        }

        // $classe = Classe::find(session()->get('id_de_la_classe'));
        $classe = session('classe_active');
       
        $classe->groupes = json_encode($arr);
        $classe->save();

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
        $groupes = Auth::user()->groupes();
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

        // $classe = Classe::find(session()->get('id_de_la_classe'));
        $classe = session('classe_active');
        $groupes = $classe->groupes;
        if ($groupes) {
            $groupes = json_decode($groupes, true);          
        } else {
            $groupes = array();
        }
        if($request->id == 'new') {
            $groupes[] = array(         
                'id' => (int)count($groupes),       
                'name' => $request->groupName,
                'backgroundColor' => $request->groupBackgroundColor,
                'textColor' => $request->groupTextColor,
            );
        } else {
            $groupes[$request->id]['id'] = (int)$request->id;
            $groupes[$request->id]['name'] = $request->groupName;
            $groupes[$request->id]['backgroundColor'] = $request->groupBackgroundColor;
            $groupes[$request->id]['textColor'] = $request->groupTextColor;
        }

        $classe->groupes = json_encode($groupes);
        $classe->save();

        session()->flash('success','Les groupes ont bien été enregistrés');
        return redirect()->route('groupe');

    }

    public function supprimerUnGroupe($id, Request $request) {
        
        $token = md5(Auth::id().$id.env('HASH_SECRET'));        
        
        
        $groupes = Auth::user()->groupes();
        
        
        $groupes = json_decode($groupes, true); 
        
        unset($groupes[$id -1]);
        
        $nbGroupe = sizeof($groupes) ?? 0;
        // $classe = Classe::find(session()->get('id_de_la_classe'));   
        $classe = session('classe_active');
        
        $gr = array_values($groupes);

        $classe->groupes = empty($gr) ? null : json_encode($gr);        
        $classe->save();

        Enfant::where('user_id', Auth::id())->where('groupe', $id-1 )->update(
            ['groupe' => null]
        );


       


        return redirect()->route('groupe')->with('groupes', $groupes)->with('nbGroupe', $nbGroupe);
    }



}
