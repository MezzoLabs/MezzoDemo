<?php

namespace App\Providers;

use App\Events\UserWasRegistered;
use App\Events\UserWasVerified;
use App\Listeners\EmailRegisterNotification;
use App\Listeners\EmailSuccessfullyVerifiedInfo;
use App\Listeners\EmailUserVerification;
use App\Listeners\UnlockUser;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserWasRegistered::class => [
            EmailUserVerification::class,
            EmailRegisterNotification::class
        ],
        UserWasVerified::class => [
            UnlockUser::class,
            EmailSuccessfullyVerifiedInfo::class
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
