<?php


namespace App\Magazine\Shop\Domain\Events;


use App\Magazine\Shop\Domain\Models\Voucher;
use App\User;

class RedeemingVoucher
{
    /**
     * @var Voucher
     */
    private $voucher;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param Voucher $voucher
     * @param User $user
     */
    public function __construct(Voucher $voucher, User $user)
    {
        $this->voucher = $voucher;
        $this->user = $user;
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