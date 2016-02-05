<?php

namespace App\Magazine\Shop\Domain\Models;


use App\Mezzo\Generated\ModelParents\MezzoVoucher;
use Carbon\Carbon;

class Voucher extends MezzoVoucher
{
    public function redeem(User $forUser = null)
    {
        if(!$forUser){
            $forUser = Auth::user();
        }

        if(!$forUser){
            throw new \Exception('Cannot redeem a voucher without a valid user.');
        }

        $this->redeemed_by_id = $forUser->id;
        $this->redeemed_at = Carbon::now();

        $this->save();
    }
}