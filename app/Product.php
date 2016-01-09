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
        return $this->belongsToMany(Order::class);
    }

    public function shoppingBaskets()
    {
        return $this->belongsToMany(ShoppingBasket::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->belongsToMany(ImageFile::class, 'image_file_product', 'product_id', 'image_file_id');
    }


}
