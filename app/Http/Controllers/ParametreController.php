<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParametreController extends Controller
{
    public function index() {
        return view('home.parametres');
    }

    public function deletePhrase($id) {
        Commentaire::find($id)->delete();
        return 'ok';
    }

    public function phrases(Request $request) {
        if ($request->section) {
            $section = Section::find($request->section);
        } else {
            $section = Section::first();
        }
        $sections = Section::all();

        return view('parametres.phrases.index')->with('sections', $sections)->with('section', $section);
    }

    public function savePhrases(Request $request) {
        if ($request->id == 'new') {
            $phrase = new Commentaire();
            $phrase->user_id = Auth::id();
            $phrase->section_id = $request->section;
            $phrase->court = '';
        } else {
            $phrase = Commentaire::find($request->id);
        }
        $phrase->texte = strip_tags($request->quill);
        $phrase->save();
        return view('parametres.phrases.__tableau_des_phrases')->with('section', Section::find($request->section));
    }
}
