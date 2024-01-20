<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MfController extends Controller
{
    public function index() {
        return view('mf.index');
    }
}
