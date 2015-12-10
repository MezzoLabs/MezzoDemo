<?php

namespace App;

use App\Magazine\Shop\Domain\Models\Product as ShopModuleProduct;
use App\Magazine\Shop\Domain\Models\ShoppingBasket;

class Product extends ShopModuleProduct
{
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Product::class);
    }

    public function shoppingBaskets()
    {
        return $this->hasMany(ShoppingBasket::class);
    }

}
