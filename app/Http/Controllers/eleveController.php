<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Resultat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class eleveController extends Controller
{

    public function liste() {
        $user = Auth::user();


        return view('eleves.liste')->with('eleves',$user->liste());
    }

    public function save(Request $request) {
        $user = Auth::user();
        $datas = $request->except(['_token']);
        $datas['mail'] = join(';', $datas['mail']);
        $datas['user_id'] = Auth::id();
        $datas['nom'] = mb_strtoupper($datas['nom']);
        $datas['prenom'] = ucfirst($datas['prenom']);
        if ($request->file('photo')) {
            $folder = $user->repertoire.'/photos/'.uniqid().'.jpg';
            $path = Storage::path($folder);
            $photo = $request->file('photo');
            $img = Image::make($photo)->encode('jpg', 75);;
            $img->resize(300,300);
            $img->save($path);
            $datas['photo'] = $folder;
        }

        $datas['annee_scolaire'] = Auth::user()->calcul_annee_scolaire();

        Enfant::updateOrCreate(['id' => $datas['id']], $datas);
        return redirect()->back();
    }
}
