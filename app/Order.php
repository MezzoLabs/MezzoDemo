<?php

namespace App;

use App\Magazine\Shop\Domain\Models\Order as ShopModuleOrder;

class Order extends ShopModuleOrder
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function merchant()
    {

    }
}
