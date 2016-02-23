<?php

namespace App\Magazine\Subscriptions\Domain\Repositories;

use App\Subscription;
use Carbon\Carbon;

class SubscriptionRepository extends \MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository
{
    /**
     * @param int $months
     * @param \App\User $user
     * @param string $plan
     * @return Subscription
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    public function addMonthsForUser(int $months, \App\User $user, string $plan = "default")
    {
        return $this->subscribeUntil(Carbon::now()->addMonths($months), $user, $plan);

    }

    public function addDaysForUser(int $days, \App\User $user, string $plan = "default")
    {
        return $this->subscribeUntil(Carbon::now()->addDays($days), $user, $plan);
    }

    public function subscribeUntil(Carbon $date, \App\User $user, string $plan = "default")
    {
        return $this->create([
            'user_id' => $user->id,
            'plan' => $plan,
            'subscribed_until' => $date,
            'cancelled' => false
        ]);
    }
}