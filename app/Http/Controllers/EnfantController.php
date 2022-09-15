<?php

namespace App\Http\Controllers;

use App\Models\Myperiode;
use PDF;
use Illuminate\Http\Request;
use App\Models\Enfant;
use Illuminate\Support\Facades\Auth;

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



    public function index() {

        $enfants = Enfant::where('user_id', Auth::id())->get();
        $avatar = '/storage/'.Auth::user()->repertoire.'/photos/avatarF.jpg';
        return view('enfants.index')->with('enfants', $enfants)->with('avatar', $avatar);
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
