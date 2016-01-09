<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;

class EmailRegisterNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        \Mail::send('emails.admin.user_registered', ['user' => $event->user], function ($message) {
            $message
                ->to(config('magazine.email.notifications.to'), 'Mezzo notification')
                ->subject('New user registered');
        });
    }
}
