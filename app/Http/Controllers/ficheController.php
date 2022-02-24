<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Models\Item;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ficheController extends Controller
{
    public function index(Request $request) {
        if (!isset($request->id)) {
            $section = Section::first();
        } else {
            $section = Section::find($request->id);
        }
        if (!isset($request->type) || $request->type == "mesfiches") {
            $fiches = Auth::user()->mesfiches($section);

        } else {
            $fiches = Auth::user()->autresfiches($section);
        }
        return view('fiches.index')
            ->with('section', $section)
            ->with('fiches', $fiches)
            ->with('sections', Section::all());
    }

    public function choix(Request $request) {
        $fiche = Fiche::where('user_id', Auth::id())->orderBy('order', 'DESC')->first();
        $order =  ($fiche) ? $fiche->order + 1 : 1;
        $fiche = new Fiche();
        $fiche->item_id = $request->fiche;
        $fiche->order = $order;
        $fiche->user_id = Auth::id();
        $fiche->save();
        return 'ok';
    }
}
