<?php

namespace App\Listeners;

use App\Events\UserWasVerified;

class EmailSuccessfullyVerifiedInfo
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
     * @param  UserWasVerified $event
     * @return void
     */
    public function handle(UserWasVerified $event)
    {
        $userData = $event->user->getAttributes();

        \Mail::send('emails.verified', $userData, function ($message) use ($userData) {
            $message
                ->to($userData['email'], $userData['name'])
                ->subject('You can now use the magazine.');
        });
    }
}
