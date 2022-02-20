<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Section;
use Illuminate\Http\Request;

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
}
