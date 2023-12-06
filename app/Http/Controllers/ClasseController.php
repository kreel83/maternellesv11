<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function createclasse() {
        return view('classes.createclasse');
    }
}
