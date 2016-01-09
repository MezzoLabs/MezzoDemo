<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use App\Events\UserWasVerified;
use App\User;

class AddDefaultRole
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
    public function handle(UserWasVerified $event)
    {
        $user = $event->user;

        $user->attachRole('user');
    }
}
