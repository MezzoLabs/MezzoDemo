<?php

namespace App\Magazine\Shop\Domain\Models;

use App\Mezzo\Generated\ModelParents\MezzoProduct;

class Product extends MezzoProduct
{

    public function getPivotAmount()
    {
        return $this->getOriginal('pivot_amount');
    }

    public function calculatePrice()
    {
        return $this->price;
    }

    public function calculatePivotPrice()
    {
        return $this->calculatePrice() * $this->getPivotAmount();
    }
}
