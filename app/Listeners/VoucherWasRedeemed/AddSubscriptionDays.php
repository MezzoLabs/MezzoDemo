<?php


namespace App\Listeners\VoucherWasRedeemed;


use App\Magazine\Shop\Domain\Events\VoucherWasRedeemed;
use App\Magazine\Subscriptions\Domain\Repositories\SubscriptionRepository;
use App\Voucher;

class AddSubscriptionDays
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptions;

    /**
     * Create the event listener.
     *
     * @param SubscriptionRepository $subscriptions
     */
    public function __construct(SubscriptionRepository $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    /**
     * Handle the event.
     *
     * @param VoucherWasRedeemed $event
     * @return bool
     */
    public function handle(VoucherWasRedeemed $event)
    {
        $voucher = $event->voucher;

        if (!$voucher->isType(Voucher::TYPE_SUBSCRIPTION)) {
            return true;
        }

        $this->subscriptions->addDaysForUser(intval($voucher->getOption('days', 0)), \Auth::user(), 'voucher');

        return true;
    }
}