<?php

namespace App\Listeners\UserWasVerified;

use App\Events\UserWasVerified;
use App\User;

class UnlockUser
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
        $user = $event->user;

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
    }
}
