<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use App\Models\Section;
use App\Models\Resultat;
use App\Models\Item;
use App\Models\Fiche;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index($id) {
        $enfant = Enfant::find($id);
        $sections = Section::all();

        $notations = $enfant->user()->notations()->get();
        $fiches =  Fiche::where('user_id', Auth::id())->orderBy('order')->get();
        $fiches = $fiches->groupBy('section_id');




        return view('items.index')
                ->with("user", Auth::user())
                ->with('fiches', $fiches)
                ->with('sections',$sections)
                ->with('enfant', $enfant)
                ->with('notations', $notations);
    }

    public function saveResultat(Request $request) {
        $search = Resultat::where('enfant_id', $request->enfant)->where('item_id', $request->item)->first();
        if ($search) {
            $search->notation_id = $request->note;
        } else {
            $item = Item::find($request->item);
            $enfant = Enfant::find($request->enfant);
            $search = new Resultat();
            $search->item_id = $request->item;
            $search->enfant_id = $request->enfant;
            $search->notation_id = $request->note;
            $search->section_id = $item->section()->id;
            $search->groupe = $enfant->groupe;
            $search->user_id = $enfant->user()->id;


        }
        $search->save();
        return 'super';
    }
}
