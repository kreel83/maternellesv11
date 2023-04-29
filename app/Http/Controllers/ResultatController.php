<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Fiche;
use App\Models\Item;
use App\Models\Notation;
use App\Models\Resultat;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultatController extends Controller
{
    public function setNote(Request $request) {
        //dd($request);
        $resultat = Resultat::where('enfant_id', $request->enfant)->where('item_id', $request->item)->first();
        $enfant = Enfant::find($request->enfant);
        $item = Item::find($request->item);
        if (!$item) {
            $item = Personnel::find($request->item);
        }
        
        if ($request->notation == 'raz') {
            $resultat->delete();

        } else {
            if ($resultat) {
                $resultat->notation_id = $request->notation;
            } else {




                $resultat = new Resultat();
                $resultat->item_id = $request->item;
                $resultat->enfant_id = $request->enfant;
                $resultat->notation_id = $request->notation;
                $resultat->user_id = Auth::id();
                $resultat->section_id = $item->section_id;
                $resultat->groupe = $enfant->groupe;

            }
            $notation = Notation::find($request->notation)->toArray();
            $resultat->save();
        }




        $fiche = Fiche::where('item_id', $request->item)->where('user_id', Auth::id())->first();
        $bloc = view('items.notation')
                ->with('notations', Auth::user()->notations()->get())
                ->with('enfant', $enfant)
                ->with('fiche', $fiche);

        return $bloc;




    }
}
