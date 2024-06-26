<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            
            if (Auth::guard($guard)->check()) {
                
                /** @var User $user */

                // to admin dashboard
                if(Auth::user()->role == 'admin') {
                    return redirect()->route('admin.index');
                }

                // to user dashboard
                else if(Auth::user()->role == 'user') {
                    return redirect()->route('depart');
                }
            }
        }

        return $next($request);
        
    }
}
