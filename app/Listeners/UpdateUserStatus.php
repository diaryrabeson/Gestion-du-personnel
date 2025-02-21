<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdateUserStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    // ✅ Mettre à jour le statut après connexion
    public function handleLogin(Login $event)
    {
        $user = $event->user;
        if ($user) {
            $user->update(['status' => 'online']);
            Log::info("✅ Utilisateur connecté : " . $user->id);
        }
    }

    // ✅ Mettre à jour le statut après déconnexion
    public function handleLogout(Logout $event)
    {
        $user = $event->user;
        if ($user) {
            $user->update(['status' => 'offline']);
            Log::info("🚪 Utilisateur déconnecté : " . $user->id);
        }
    }
}
