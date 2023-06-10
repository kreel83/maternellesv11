<?php

namespace App\Http\Controllers\Direction;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class UserControllerDirection extends Controller
{
    public function decodirection() {
        Auth::guard('direction')->logout();
        return redirect(RouteServiceProvider::DASHBOARDPRO);
        //return redirect()->route('enfants');
    }
}
