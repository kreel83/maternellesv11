<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tuto;
use App\Models\User;

class TutoController extends Controller
{
    public function index(Request $request) {
        $t = Tuto::where('keyword', $request->type)->first();
        $texte = $t->texte;
        $liste = Tuto::where('origine', $t->id)->get();


        return [$t->etape.'-'.$t->position,$t->texte, $t->id];
    }

    public function ajax(Request $request) {
        $origine = Tuto::find($request->position)->origine;
        if ($request->sens == 'left') {
            $new = Tuto::where('id', '<', $request->position)->where('origine', $origine)->orderBy('id','DESC')->first();
        } else {
            $new = Tuto::where('id', '>', $request->position)->where('origine', $origine)->first();
        }
        return $new;
    }
}
