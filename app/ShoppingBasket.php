<?php

namespace App;

use App\Magazine\Shop\Domain\Models\ShoppingBasket as ShopModuleBasket;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingBasket extends ShopModuleBasket
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
