<?php

namespace App;

use App\Magazine\Shop\Domain\Models\Voucher as ShopModuleVoucher;

class Voucher extends ShopModuleVoucher
{
    const TYPE_DEFAULT = 'default';
    const TYPE_SUBSCRIPTION = 'subscription';
    const TYPE_COUPON = 'coupon';

    public function redeemedBy()
    {
        return $this->belongsTo(User::class, 'redeemed_by_id', 'id');
    }

    public function onlyFor()
    {
        return $this->belongsTo(User::class, 'only_for_id', 'id');
    }

    public function redeemedByUsers()
    {
        return $this->belongsToMany(\App\User::class, 'redeemed_vouchers');
    }


}
