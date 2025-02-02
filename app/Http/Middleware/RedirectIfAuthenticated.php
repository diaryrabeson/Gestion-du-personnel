<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\PreventBackHistory;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            $user = Auth::user();

            // Redirige vers le tableau de bord approprié selon le rôle
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'client') {
                return redirect()->route('client.dashboard');
            }
        }

        // Si l'utilisateur n'est pas authentifié, continue vers la page demandée
        return $next($request);
    }
}
