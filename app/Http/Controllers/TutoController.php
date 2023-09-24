<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tuto;
use App\Models\Tutoriel;
use App\Models\User;

class TutoController extends Controller
{
    public function index(Request $request) {
            
        //dd($request->tuto_type);
        $liste = Tutoriel::where('page', $request->page)->get();
        $t = $liste->first();
        $next = $liste->skip(1)->first();
        


        // $t = Tuto::where('keyword', $request->tuto_type)->first();
        // $nb = Tuto::where('etape', $t->etape)->count();
        
        // $texte = $t->texte;
        // $liste = Tuto::where('origine', $t->id)->get();
        if (!$t) return 'none';


        return [$t->titre,$t->texte, $t->etape, $liste->count(), $t->champ, $next->champ ?? null, $t->action];
    }

    public function ajax(Request $request) {
        $new = Tutoriel::where('page', $request->page)->where('etape', $request->etape)->first();

        return $new;

        // $actual = Tuto::where('etape', $request->etape)->where('ordre', $request->order)->first();

        // if ($request->sens == 'left') {
        //     $new = Tuto::where('id', '<', $actual->id)->where('origine', $actual->origine)->orderBy('ordre','DESC')->first();
        // } else {
        //     $new = Tuto::where('id', '>', $actual->id)->where('origine', $actual->origine)->orderBy('ordre','ASC')->first();
        // }
        // return $new;
    }
}
