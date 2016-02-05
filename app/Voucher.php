<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Magazine\Shop\Domain\Models\Voucher as ShopModuleVoucher;

class Voucher extends ShopModuleVoucher
{
    public function redeemedBy()
    {
        return $this->belongsTo(User::class, 'redeemed_by_id', 'id');
    }


}
