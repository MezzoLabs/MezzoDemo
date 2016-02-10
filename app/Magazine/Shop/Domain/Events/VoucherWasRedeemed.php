<?php


namespace App\Magazine\Shop\Domain\Events;


use App\Magazine\Shop\Domain\Models\Voucher;

class VoucherWasRedeemed
{
    /**
     * @var Voucher
     */
    private $voucher;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
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