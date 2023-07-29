<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
        //return redirect(route('admin.login'));
    }

    public function register(): View
    {
        return view('admin.register');
    }

    public function checkcode($code)
    {
        $ecole = new Ecole;
        return $ecole->checkcode($code);
    }

    public function contact(): View
    {
        return view('contact.admin')
            ->with('route', '');
    }

    /**
     * Affiche le profi de l'adminsitrateur
     *
     * @return View
     */
    function loadAdminProfile(): View
    {
        $user = Auth::user();        
        $ecole = Ecole::select('nom_etablissement','adresse_1','adresse_2','adresse_3','telephone')
            ->where('identifiant_de_l_etablissement', $user->ecole_id)
            ->first();
        $adresseEcole = $ecole->nom_etablissement;
        if($ecole->adresse_1 != '') { $adresseEcole .= ', '.$ecole->adresse_1; }
        if($ecole->adresse_2 != '') { $adresseEcole .= ', '.$ecole->adresse_2; }
        if($ecole->adresse_3 != '') { $adresseEcole .= ', '.$ecole->adresse_3; }
        return view('admin.profil')
            ->with('user', $user)
            ->with('adresseEcole', $adresseEcole)
            ->with('telephoneEcole', $ecole->telephone);
    }

    /**
     * Enregistre le profil de l'administrateur
     *
     * @param Request $request
     * @return
     */
    public function saveAdminProfile(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'mobile' => ['max:20'],
            'directeur' => ['required'],
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom est limité à 255 caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom est limité à 255 caractères.',
            'mobile.max' => 'Le numéro de mobile est limité à 20 caractères.',
            'directeur.required' => 'Merci de renseigner la section Directeur / Directrice.',
        ]);

        $user = Auth::user();
        $user->name = strtoupper($request->nom);
        $user->prenom = strtoupper($request->prenom);
        $user->directeur = (int) $request->directeur;
        $user->mobile = $request->mobile;
        $user->save();
        return redirect()->back()->with('result', 'success');
    }

}
