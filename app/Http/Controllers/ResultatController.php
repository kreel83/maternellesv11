<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Item;
use App\Models\Notation;
use App\Models\Resultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultatController extends Controller
{
    public function setNote(Request $request) {
        if ($request->notation == "null")  return false;
            $resultat = Resultat::where('enfant_id', $request->enfant)->where('item_id', $request->item)->first();
            if ($resultat) {
                $resultat->notation_id = $request->notation;
            } else {
                $item = Item::find($request->item);
                $enfant = Enfant::find($request->enfant);

                $resultat = new Resultat();
                $resultat->item_id = $request->item;
                $resultat->enfant_id = $request->enfant;
                $resultat->notation_id = $request->notation;
                $resultat->user_id = Auth::id();
                $resultat->section_id = $item->section()->id;
                $resultat->groupe = $enfant->groupe;

            }
            $notation = Notation::find($request->notation)->toArray();
            $resultat->save();
            return $notation;




    }
}
