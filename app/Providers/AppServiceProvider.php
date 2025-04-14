<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Conger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            // Partager le nombre de congés en attente avec toutes les vues
    View::composer('layouts.menuAdmin', function ($view) {
        $congesEnAttente = Conger::where('status', 'en attente')->count();
        $view->with('congesEnAttente', $congesEnAttente);
    });

       View::share('user', Auth::user());
    }
}
