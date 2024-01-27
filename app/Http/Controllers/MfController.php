<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MfController extends Controller
{
    public function index() {
        return view('mf.index');
    }
    public function contact() {
        return view('mf.contact');
    }
    public function application() {
        return view('mf.application');
    }
    public function compagnon() {
        return view('mf.compagnon');
    }
    public function tarification() {
        return view('mf.tarification');
    }
}
