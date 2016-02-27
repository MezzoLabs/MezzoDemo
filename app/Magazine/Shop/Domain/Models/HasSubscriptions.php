<?php


namespace App\Magazine\Shop\Domain\Models;


use App\Subscription;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property EloquentCollection $subscriptions
 * @method HasMany subscriptions
 */
trait HasSubscriptions
{
    public function isSubscribed()
    {
        return !!$this->activeSubscription();
    }

    public function activeSubscription()
    {
        return $this->activeSubscriptions()->first();
    }

    public function activeSubscriptions()
    {
        return $this->subscriptions->filter(function (Subscription $subscription) {
            return $subscription->isActive();
        })->sortBy('subscribed_until');
    }
}