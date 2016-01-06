<?php

namespace App\LockableResources;


use Carbon\Carbon;

interface LockableResource
{
    /**
     * Locks this resource for other users.
     *
     * @param \App\User $user
     * @param int|Carbon $minutes
     */
    public function lock(\App\User $user, $minutes);

    /**
     * Unlocks this resource, so other users can access it again.
     */
    public function unlock();

    /**
     * @return bool
     */
    public function isLocked();

    /**
     * @return bool
     */
    public function isLockedForUser(\App\User $user = null);

    /**
     * @return \App\User|null
     */
    public function lockedBy();

    /**
     * @return \Carbon\Carbon|null
     */
    public function lockedUntil();
}