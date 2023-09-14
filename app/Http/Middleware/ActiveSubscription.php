<?php

namespace App\Http\Middleware;

use App\Models\Licence;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //$request->session()->forget('isAuthenticated');
        // verifie si l'utilisateur a une licence active
        if (!$request->session()->exists('isAuthenticated')) {
            switch(Auth::user()->licence) {
                case('admin'):
                    // Licence accordée par l'école
                    $licence = Licence::where([
                        ['user_id', Auth::user()->id],
                        ['actif', 1],
                    ])->first();
                    if(!$licence) {
                        //return redirect(route('depart'));
                        return redirect(route('depart'))->with('nolicence', true);
                    } else {
                        $request->session()->put('isAuthenticated', true);
                    }
                    break;
                case('self'):
                    // licence prise individuellement
                    $subscription = Subscription::where([
                        ['user_id', Auth::user()->id],
                        ['stripe_status', 'active'],
                    ])->first();
                    if(!$subscription) {
                        //return redirect(route('depart'));
                        return redirect(route('depart'))->with('nolicence', true);
                    } else {
                        $request->session()->put('isAuthenticated', true);
                    }
                    break;
                default:
                    return redirect(route('depart'))->with('nolicence', true);
            }
        }
        return $next($request);
    }
}
