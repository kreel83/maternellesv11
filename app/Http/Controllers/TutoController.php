<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\Tutoriel;
use Illuminate\Support\Facades\Auth;

class TutoController extends Controller
{
    public function index(Request $request) {
            
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

    public function modetuto(Request $request) {

        $state  = ($request->state == 'on') ? 1 : 0;
        $conf = Configuration::where('user_id', Auth::id())->first();
        if (!$conf) return 'ko';
        $conf->tuto = $state;
        $conf->save();
        if ($request->ajax()) return 'ok';
        return redirect()->back();
        
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
