<?php

namespace App\Http\Middleware;
use App\Http\Controllers\CongerController;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileEmployerController;


class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Si l'utilisateur est connecté
        if (Auth::check()) {
            $user = Auth::user();

            // Si l'utilisateur est déjà sur son tableau de bord, ne pas rediriger
            if (($user->role === 'admin' && $request->routeIs('admin.dashboard')) ||
                ($user->role === 'client' && $request->routeIs('client.dashboard'))) {
                $response = $next($request);

                // Désactiver le cache pour le tableau de bord
                return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                                ->header('Pragma', 'no-cache')
                                ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
            }

            // Empêcher l'accès aux pages de connexion, inscription ou accueil si l'utilisateur est connecté
            if ($request->routeIs('login') || $request->routeIs('register') || $request->is('/')) {
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === 'client') {
                    return redirect()->route('client.dashboard');
                }
            }
        }

        // Exécuter la requête suivante
        $response = $next($request);

        // Désactiver le cache pour éviter les retours en arrière sur les pages sensibles
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
