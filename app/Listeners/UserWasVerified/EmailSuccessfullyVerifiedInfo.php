<?php

namespace App\Listeners\UserWasVerified;

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
                ->to($userData['email'], $userData['first_name'] . ' ' . $userData['last_name'])
                ->subject('You can now use the magazine.');
        });
    }
}
