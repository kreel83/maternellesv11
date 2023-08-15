<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( Auth::check() )
        {
            switch(Auth::user()->role) {
                case('user'):
                    // Si l'utilisateur n'est pas un admin on le renvoi sur son dashboard
                    return redirect(route('depart'));
                    break;
                case('admin'):
                    // Sinon on redirige l'admin sur son dashboard
                    return $next($request);
                    break;
            }
        }
        abort(403);  // permission denied error
    }
}
