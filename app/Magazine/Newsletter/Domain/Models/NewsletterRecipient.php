<?php


namespace App\Magazine\Newsletter\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoNewsletterRecipient;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class NewsletterRecipient extends MezzoNewsletterRecipient
{
    const STATE_CONFIRMATION_PENDING = "confirmation_pending";
    const STATE_CONFIRMED = "confirmation_received";
    const STATE_REJECTED = "rejected";
    const STATE_BLACKLISTED = "blacklisted";

    public function scopeConfirmedOnly(EloquentBuilder $query)
    {
        return $query->where('state', '=', static::STATE_CONFIRMED);
    }
}