<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Observers\UserObserver; 
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    User::observe(UserObserver::class);

    //    parent::boot();

    // Event::listen(Login::class, function ($event) {
    //     $user = $event->user;
    //     $user->update(['status' => 'online']);
    // });

    // Event::listen(Logout::class, function ($event) {
    //     $user = $event->user;
    //     if ($user) {
    //         $user->update(['status' => 'offline']);
    //     }
    // });
    }

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
