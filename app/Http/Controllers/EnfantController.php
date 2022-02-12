<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfant;
use Illuminate\Support\Facades\Auth;

class EnfantController extends Controller

{





    public function index() {
        
        $enfants = Enfant::where('user_id', Auth::id())->get();
        $avatar = '/storage/'.Auth::user()->repertoire.'/photos/avatarF.jpg';              
        
        return view('enfants.index')->with('enfants', $enfants)->with('avatar', $avatar);
    }
}
