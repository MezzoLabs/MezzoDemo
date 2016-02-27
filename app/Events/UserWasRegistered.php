<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

abstract class UserWasRegistered extends Event
{
    use SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var bool
     */
    public $subscribeToNewsletter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $subscribeToNewsletter = false)
    {
        //
        $this->user = $user;
        $this->subscribeToNewsletter = $subscribeToNewsletter;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
