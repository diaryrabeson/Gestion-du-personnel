<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Observers\UserObserver; 
use Illuminate\Support\Facades\Auth;
use App\Listeners\UpdateUserStatus;  
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Logout;       

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
       Login::class => [
        [UpdateUserStatus::class, 'handleLogin'], // Mise à jour après connexion
    ],
    Logout::class => [
        [UpdateUserStatus::class, 'handleLogout'], // Mise à jour après déconnexion
    ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
