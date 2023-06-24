<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminProfilController extends Controller
{

    function loadAdminProfile(): View
    {
        $user = Auth::user();
        $ecole = Ecole::where('identifiant_de_l_etablissement', $user->ecole_id)->first();//->pluck('nom_etablissement','adresse_1','adresse_2','adresse_3');
        return view('admin.profile')
            ->with('user', $user)
            ->with('ecole', $ecole);
    }

    public function saveAdminProfile(Request $request) {

        $user = Auth::user();
        $user->name = strtoupper($request->nom);
        $user->prenom = strtoupper($request->prenom);
        //$user->ecole_id = strtoupper($request->ecole_id);
        $user->directeur = (int) $request->directeur;
        $user->save();
        
        return view("admin.index")
            ->with('saveadminprofile', 'success');

    }

}
