<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\Enfant;
use App\Models\Resultat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index(): View
    {
        $enseignants = User::where([
            ['ecole_identifiant_de_l_etablissement', Auth::user()->ecole_identifiant_de_l_etablissement],
            ['id', '<>', Auth::id()],
        ])->get();
        return view('admin.index')
            -> with('enseignants', $enseignants);
    }

    public function voirClasse($id): View
    {
        $enseignants = User::where([
            ['ecole_identifiant_de_l_etablissement', Auth::user()->ecole_identifiant_de_l_etablissement],
            ['id', '<>', Auth::id()],
        ])->get();
        $listeDesEleves = Enfant::where('user_id', $id)->get();
        $prof = User::find($id);
        return view('admin.index')
            ->with('prof', $prof)
            ->with('listeDesEleves', $listeDesEleves)
            -> with('enseignants', $enseignants);
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
            ->with('route', route('admin.contact.post'));
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
            ->where('identifiant_de_l_etablissement', $user->ecole_identifiant_de_l_etablissement)
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

    /**
     * Changer le mot de passe de l'adminsitrateur
     *
     * @return View
     */
    function changerLeMotDePasse(): View
    {

        return view('admin.motdepasse');
    }

    public function sauverLeMotDePasse(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.required' => 'Mot de passe obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe a échouée.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);
 

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('result', 'success');
    }

    public function chercherUnEleve(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string'],
        ], [
            'search.required' => 'Le champ de recherche ne peut pas être vide',
            'search.string' => 'Le format de recherche est invalide.',
        ]);

        $result = Enfant::select('enfants.id', 'enfants.nom as eleveNom','enfants.prenom as elevePrenom',
            'users.name as userNom','users.prenom as userPrenom','enfants.genre','enfants.background','enfants.photo')
            ->where(function ($query) use ($request) {
                $query->where('enfants.nom', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('enfants.prenom', 'LIKE', '%'.$request->search.'%');
            })
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->where('users.ecole_identifiant_de_l_etablissement', Auth::user()->ecole_identifiant_de_l_etablissement)
            ->get();
        return redirect()->back()->with('result', $result);
    }



    public function voirEleve($user_id, $id)
    {        
        $eleve = Enfant::find($id);
        $resultats = Resultat::resultatsPourUnEleve($id);
        return view('admin.voir_eleve')
            ->with('user_id', $user_id)     // id du prof pour retour sur le dashboard et reafficher la classe si besoin
            ->with('role', Auth::user()->role)
            ->with('resultats', $resultats)
            ->with('eleve', $eleve);
    }

}
