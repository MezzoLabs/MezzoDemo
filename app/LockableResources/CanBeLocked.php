<?php

namespace App\LockableResources;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait CanBeLocked
{
    /**
     * Locks this resource for other users.
     *
     * @param \App\User $user
     * @param int|Carbon $minutes
     */
    public function lock(\App\User $user = null, $minutes = 5)
    {
        if (!$user)
            $user = Auth::user();

        if (!$user) {
            throw new ResourceLockException('You have to be logged in to lock a resource');
        }

        if ($this->isLockedForUser($user)) {
            throw new ResourceLockException('Cannot lock a resource that is already locked by "' . $this->lockedById() . '""');
        }

        $lockUntil = Carbon::now()->addMinutes($minutes);

        $this->locked_by_id = $user->id;
        $this->locked_until = $lockUntil;
        $this->save();
    }

    /**
     * Unlocks this resource, so other users can access it again.
     */
    public function unlock()
    {
        $this->locked_by_id = null;
        $this->locked_until = null;
        $this->save();
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        $lockedUntil = $this->lockedUntil();

        if (!$lockedUntil)
            return false;

        return $this->lockedUntil()->timestamp >= Carbon::now()->timestamp;
    }

    /**
     * @return bool
     */
    public function isLockedForUser(\App\User $user = null)
    {
        if (!$this->isLocked())
            return false;

        if (!$user) {
            $user = Auth::user();
        }

        if (!$user) {
            return true;
        }

        return $user->id != $this->lockedById();
    }


    /**
     * @return integer
     */
    public function lockedById()
    {
        return $this->locked_by_id;
    }

    /**
     * @return \Carbon\Carbon|null
     */
    public function lockedUntil()
    {
        return $this->locked_until;
    }
}