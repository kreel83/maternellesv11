<?php

namespace App\Http\Controllers;

use App\Models\Myperiode;
use PDF;
use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Reussite;
use Illuminate\Support\Facades\Auth;
use File;

class EnfantController extends Controller

{

    private  function generateRandomString($length1, $length2) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $charactersLength = strlen($characters);
        $numbersLength = strlen($numbers);
        $randomString = '';
        for ($i = 0; $i < $length1; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        for ($i = 0; $i < $length2; $i++) {
            $randomString .= $numbers[rand(0, $numbersLength - 1)];
        }
        return $randomString;
    }


    public function parent() {
        return view('parent.parent');
    }


    public function parent_mdp(Request $request) {
        $enfant = Enfant::where('mdp', $request->mdp)->first();
        if ($enfant) return view('parent.pdf');
        return redirect()->back()->withError('non non non ');
    }

    public function reussite(Request $request) {

        $enfants = Enfant::where('user_id', Auth::id())->get();
        $ordre = $request->ordre ?? 'alpha';
        switch($ordre) {
            case 'age' : $enfants = Enfant::where('user_id', Auth::id())->orderBy('ddn','DESC')->get();break;
            case 'alpha' : $enfants = Enfant::where('user_id', Auth::id())->orderBy('prenom')->get();break;
            case 'groupe' : $enfants = Enfant::where('user_id', Auth::id())->get();$enfants = $enfants->groupBy('groupe');break;
        }
        

        // Verifie les cahiers de reussite pour savoir si ils sont tous faits
        // non existant dans la table / definitif = 0
        // Ok si nombre de cahiers avec defintif = 1 est égal au nombre d'enfants dans la classe
        $nbEnfants = Enfant::where([
            ['user_id', Auth::id()],
            ['reussite', 1]
        ])->count();
        $nbReussite = Reussite::where([
            ['user_id', Auth::id()],
            ['definitif', 1],
        ])->count();
        // bool flag pour autoriser l'envoi des PDFs
        $canSendPDF = ($nbEnfants == $nbReussite);

    // foreach ($enfants as $enfant) {
    //     $degrade = Enfant::DEGRADE;
    //     $enfant->background = array_rand($degrade);
    //     $files = File::files(public_path('img/animaux'));
    //     $liste = array();
    //     foreach ($files as $file) {
    //         $liste[] = $file->getFileName();
    //     }
    //     $k = array_rand($liste);
        
    //     $enfant->photo = $liste[$k];
    //     $enfant->save();
    // }

        $avatar = '/storage/'.Auth::user()->repertoire.'/photos/avatarF.jpg';
        
        return view('reussite.index')
            ->with('canSendPDF', $canSendPDF)
            ->with('ordre', $ordre )
            ->with('enfants', $enfants)
            ->with('avatar', $avatar);
    }

    public function index(Request $request) {
        $enfants = Enfant::where('user_id', Auth::id())->get();
        $ordre = $request->ordre ?? 'alpha';
        switch($ordre) {
            case 'age' : $enfants = Enfant::where('user_id', Auth::id())->orderBy('ddn','DESC')->get();break;
            case 'alpha' : $enfants = Enfant::where('user_id', Auth::id())->orderBy('prenom')->get();break;
            case 'groupe' : $enfants = Enfant::where('user_id', Auth::id())->get();$enfants = $enfants->groupBy('groupe');break;
        }

        $avatar = '/storage/'.Auth::user()->repertoire.'/photos/avatarF.jpg';
        
        return view('enfants.index')
            ->with('type', $request->type)
            ->with('ordre', $ordre)
            ->with('enfants', $enfants)
            ->with('avatar', $avatar);
    }


    public function password() {
        $user = Auth::user();
        $enfants = $user->liste();
        return view('password.index')->with('enfants', $enfants);
    }

    public function password_operation(Request $request) {
        $datas = $request->except(['_token']);
        $enfants = Enfant::whereIn('id', $datas['enfants'])->get();
        if ($datas['submit'] == 'password') {
            foreach ($enfants as $enfant) {
                $enfant->mdp = $this->generateRandomString(6,2);
                $enfant->save();
            }
        } else {
            $pdf = PDF::loadView('pdf.mdp', ['enfants' => $enfants]);
            return $pdf->stream('liste_mots_de_passe.pdf');
        }


        return redirect()->back();
    }


    public function password_pdf() {
        dd('coucou');
    }
}
