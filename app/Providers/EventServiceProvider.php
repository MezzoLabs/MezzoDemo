<?php

namespace App\Providers;

use App\Events\UserWasRegistered;
use App\Events\UserWasRegisteredWithEmail;
use App\Events\UserWasRegisteredWithSocialAuthentication;
use App\Events\UserWasVerified;
use App\Events\UserWasVerifiedWithEmail;
use App\Events\UserWasVerifiedWithSocialAuthentication;
use App\Listeners\AddDefaultRole;
use App\Listeners\EmailRegisterNotification;
use App\Listeners\EmailUserVerification;
use App\Listeners\UserWasVerified\EmailSuccessfullyVerifiedInfo;
use App\Listeners\UserWasVerified\SubscribeToNewsletter;
use App\Listeners\UserWasVerified\UnlockUser;
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
        UserWasRegisteredWithEmail::class => [
            EmailUserVerification::class,
            EmailRegisterNotification::class
        ],
        UserWasRegisteredWithSocialAuthentication::class => [
            //EmailRegisterNotification::class
        ],
        UserWasVerifiedWithEmail::class => [
            UnlockUser::class,
            EmailSuccessfullyVerifiedInfo::class,
            AddDefaultRole::class,
            SubscribeToNewsletter::class
        ],
        UserWasVerifiedWithSocialAuthentication::class => [
            AddDefaultRole::class,
            SubscribeToNewsletter::class
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
