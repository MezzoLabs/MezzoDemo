<?php

namespace App;

use App\Magazine\Shop\Domain\Models\Merchant as ShopModuleMerchant;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchant extends ShopModuleMerchant
{
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
}
