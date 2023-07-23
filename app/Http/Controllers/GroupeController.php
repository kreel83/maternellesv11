<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupeController extends Controller
{
    public function index() {
        $type = Auth::user()->type_groupe;
        $groupe = Auth::user()->groupe;
        if ($type == 'termes') {
            $groupe = join(PHP_EOL, $groupe );
        } else {

        }
        
        return view('groupes.index')
            ->with('type', $type)
            ->with('groupe', $groupe);
    }

    public function affectation_groupe() {
        $eleves = Auth::user()->liste();
        return view('groupes.affectation_groupe')
            ->with('eleves', $eleves)
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
        $user = Auth::user();
        Enfant::where('user_id', $user->id)->update([
            'groupe' => null
        ]);

        $r = $request->tableau;
        $liste = explode(PHP_EOL, $r);
        $liste = join('/', $liste);
        $user->groupes = $liste;
        $user->save();

        return 'ok';
    }
}
