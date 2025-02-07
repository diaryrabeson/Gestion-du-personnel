<?php

namespace App\Http\Middleware;
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     if (Auth::check()) {
    //         // Forcer la mise à jour en base
    //         Auth::user()->update(['status' => 'online']);
    //     }

    //     return parent::handle($request, $next, ...$guards);
    // }
}

