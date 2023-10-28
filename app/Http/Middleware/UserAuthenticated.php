<?php

namespace App\Http\Middleware;

use App\Models\Enfant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Récupération des paramètres passés dans les routes :
        // tous : $request->route()->parameters() / 1 seul : $request->route('nom_parametre')
        // $request->route()->getActionMethod()  ->  renvoi le nom de la route : ->name('')
        if(!empty($request->route('enfant_id'))) {
            /*
            Benchmark::dd([
                    'scenario 1' => fn () => Enfant::where('id', $request->route('id'))->where('user_id', Auth::id())->first(),
                    'scenario 2' => fn () => Enfant::find($request->route('id')),
            ]);
            */
            $enfant = Enfant::find($request->route('enfant_id'));
            if($enfant) {
                $is_ok = ($enfant->user_id == Auth::id());
            }
            if(empty($enfant) || !$is_ok) {
                return redirect()->route('error')->with('msg', 'Aucun élève trouvé.');
            }
        }

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
