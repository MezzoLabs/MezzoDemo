<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;

class EmailUserVerification
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
        $userData = $event->user->getAttributes();

        \Mail::send('emails.verify', $userData, function ($message) use ($userData) {
            $message
                ->to($userData['email'], $userData['first_name'] . ' ' . $userData['last_name'])
                ->subject('Verify your email address');
        });
    }
}
