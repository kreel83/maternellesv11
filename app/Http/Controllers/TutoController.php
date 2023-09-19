<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tuto;

class TutoController extends Controller
{
    public function index(Request $request) {
        $t = Tuto::where('keyword', $request->type)->first();

        return [$t->etape.'-'.$t->position,$t->texte];
    }
}
