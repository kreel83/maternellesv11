<?php

namespace App\Http\Middleware;

use App\Models\Classe;
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

        $id_enfant = null;
        if ($request->route('enfant_id')) $id_enfant = $request->route('enfant_id');
        if ($request->enfant_id) $id_enfant = $request->enfant_id;
        
        if (!$request->session()->has('classe_active') && !is_null(Auth::user()->classe_id)) {
            $classeActive = Classe::find(Auth::user()->classe_id);
            
            if ($classeActive) {
                session(['classe_active' => $classeActive]);
                session(['is_enfants' => Classe::is_enfants()]);
                session(['autres_classes' => Auth::user()->autresClasses()]);
            }
        }

        if (!$request->session()->has('is_abonne')) {
            session(['is_abonne' => Auth::user()->is_abonne()]);
        }

        // Récupération des paramètres passés dans les routes :
        // tous : $request->route()->parameters() / 1 seul : $request->route('nom_parametre')
        // $request->route()->getActionMethod()  ->  renvoi le nom de la route : ->name('')
        if($id_enfant) {
            $enfant = Enfant::find($id_enfant);
            if(!$enfant) {
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
