<?php

namespace App;

use App\Magazine\Subscriptions\Domain\Repositories\SubscriptionRepository;
use App\Mezzo\Generated\ModelParents\MezzoSubscription;
use Carbon\Carbon;

class Subscription extends MezzoSubscription
{
    protected $dates = [
        'subscribed_until'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return SubscriptionRepository
     * @throws RepositoryException
     */
    public static function repository()
    {
        return app()->make(SubscriptionRepository::class);
    }

    public function isActive()
    {
        return $this->subscribed_until->gte(Carbon::now());

    }


    public function duration()
    {
        return $this->created_at->diff($this->subscribed_until);
    }

}
