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
            /** @var User $user */
            $user = Auth::user();

            // if user is not admin take him to his dashboard

             if ( $user->hasRole('user') ) {
                return redirect(route('user_dashboard')); // A VOIR !!!!!!!!!!!!!!!!!
            }

            // allow admin to proceed with request
            else if ( $user->hasRole('admin') ) {

                return $next($request);
            }
        }

        abort(403);  // permission denied error
    }
}
