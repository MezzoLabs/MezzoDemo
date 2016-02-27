<?php


namespace App\Magazine\Shop\Domain\Repositories;


use App\Magazine\Shop\Domain\Models\Voucher;
use App\Magazine\Shop\Exceptions\InvalidVoucherException;
use App\User;
use Carbon\Carbon;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class VoucherRepository extends ModelRepository
{
    /**
     * Redeem a voucher.
     *
     * @param Voucher $voucher
     * @param User|null $user
     * @return Voucher
     * @throws InvalidVoucherException
     */
    public function redeem(Voucher $voucher, User $user)
    {
        if (!$voucher->canBeRedeemedBy($user)) {
            return null;
        }

        if (!$voucher->is_global) {
            return $this->redeemPrivateVoucher($voucher, $user);
        }

        $user->redeemedGlobalVouchers()->attach($voucher->id);

        return $voucher;
    }

    /**
     * @param Voucher $voucher
     * @param User $user
     * @return Voucher
     */
    protected function redeemPrivateVoucher(Voucher $voucher, User $user)
    {
        $voucher->redeemed_by_id = $user->id;
        $voucher->redeemed_at = Carbon::now();

        $voucher->save();

        return $voucher;
    }

    /**
     * @param $code
     * @return Voucher
     */
    public function findByKeyOrFail($code)
    {
        return $this->findByOrFail('voucher_key', $code);
    }


}