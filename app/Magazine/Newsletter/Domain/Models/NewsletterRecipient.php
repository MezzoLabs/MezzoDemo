<?php


namespace App\Magazine\Newsletter\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoNewsletterRecipient;

class NewsletterRecipient extends MezzoNewsletterRecipient
{
    const STATE_CONFIRMATION_PENDING = "confirmation_pending";
    const STATE_CONFIRMED = "confirmed";
    const STATE_REJECTED = "rejected";


}