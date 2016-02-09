<?php

namespace App\Magazine\Shop\Domain\Models;


use App\Magazine\Shop\Domain\Repositories\VoucherRepository;
use App\Magazine\Shop\Domain\Services\VoucherService;
use App\Mezzo\Generated\ModelParents\MezzoVoucher;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

class Voucher extends MezzoVoucher
{
    public function redeem(User $forUser = null)
    {
        return app()->make(VoucherService::class)->redeem($this, $forUser);
    }

    /**
     * Data that will be added to the request if the field is empty
     *
     * @param array $requestData
     * @return array
     */
    public function defaultData(array $requestData) : array
    {
        return [
            'voucher_key' => Str::random(10),
            'type' => 'default'
        ];
    }

    /**
     * @return VoucherRepository
     * @throws RepositoryException
     */
    public static function repository()
    {
        return parent::repository();
    }

    public function isPrivate()
    {
        return $this->is_global == 0;
    }

    public function isRedeemed()
    {
        if ($this->isPrivate()) {
            return (boolean)$this->redeemed_at;
        }

        return false;
    }

    public function isRedeemedBy(User $user)
    {
        if ($this->isPrivate()) {
            return $this->redeemed_by_id == $user->id;
        }

        return $user->redeemedGlobalVouchers->keyBy('id')->has($this->id);
    }

    public function isActive()
    {
        if ($this->isRedeemed()) {
            return false;
        }

        if ($this->active_until->lte(Carbon::now())) {
            return false;
        }

        return true;
    }


    public function canBeRedeemedBy(User $user)
    {
        if (!$this->isActive()) {
            return false;
        }

        if ($this->isRedeemedBy($user)) {
            return false;
        }

        return true;
    }


}