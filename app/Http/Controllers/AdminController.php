<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function initClasse() {
        $Enfants = Enfant::all();
        foreach ($Enfants as $enfant) {
            $enfant->user_n2_id = $enfant->user_n1_id;
            $enfant->user_n1_id = $enfant->user_id;
            $enfant->user_id = null;
            $enfant->save();

            
        }
        return back()->with('success','MAJ faite');
    }

    public function recupClasse() {
        
        $u = Auth::id();
        $Enfants = Enfant::where('user_n1_id', $u)->get();

        foreach ($Enfants as $enfant) {            
            $enfant->user_id = $enfant->user_n1_id;
            $enfant->save();            
        }
        return back()->with('success','Récupération');
    }
}
