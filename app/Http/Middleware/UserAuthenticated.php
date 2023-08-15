<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserAuthenticated
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
                case('admin'):
                    // Si l'utilisateur n'est pas un user on le renvoi sur son dashboard
                    return redirect(route('admin.index'));
                    break;
                case('user'):
                    // Sinon on redirige le user sur son dashboard
                    return $next($request);
                    break;
            }
        }
        abort(403);  // permission denied error
    }
}
