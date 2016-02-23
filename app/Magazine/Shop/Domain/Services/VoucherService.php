<?php


namespace App\Magazine\Shop\Domain\Services;


use App\Magazine\Shop\Domain\Events\RedeemingVoucher;
use App\Magazine\Shop\Domain\Events\VoucherWasRedeemed;
use App\Magazine\Shop\Domain\Models\Voucher;
use App\Magazine\Shop\Domain\Repositories\VoucherRepository;
use App\Magazine\Shop\Exceptions\InvalidVoucherException;
use App\User;
use Illuminate\Support\Facades\Auth;

class VoucherService
{


    public function __construct()
    {

    }

    /**
     * @param Voucher $voucher
     * @param User|null $user
     * @return bool
     * @throws InvalidVoucherException
     */
    public function redeem(Voucher $voucher, User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        if (!$user) {
            throw new InvalidVoucherException('You need a valid user to redeem a voucher.');
        }

        $redeemingVoucherChain = event(new RedeemingVoucher($voucher, $user), [], true);

        if ($redeemingVoucherChain === false) {
            return false;
        }

        $redeemed = $this->repository()->redeem($voucher, $user);

        if (!$redeemed) {
            return false;
        }

        event(new VoucherWasRedeemed($voucher));

        return true;
    }


    /**
     * @return VoucherRepository
     */
    public function repository()
    {
        return app()->make(VoucherRepository::class);
    }
}