<?php


namespace App\Magazine\Shop\Domain\Repositories;


use App\Magazine\Shop\Domain\Models\Product;
use App\Magazine\Shop\Domain\Models\ShoppingBasket;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class ShoppingBasketRepository extends ModelRepository
{

    /**
     * @param ShoppingBasket $basket
     * @param Product $product
     * @param int $amount
     */
    public function addProduct(ShoppingBasket $basket, Product $product, int $amount = 1)
    {
        $existingProductEntry = $this->existingProductEntry($basket, $product);

        if ($existingProductEntry) {
            $oldAmount = intval($existingProductEntry->getOriginal('pivot_amount'));

            $basket->products()->updateExistingPivot($product->id, ['amount' => $oldAmount + $amount]);
            return;
        }

        if ($amount == 0) {
            $this->removeProduct($basket, $product);
            return;
        }

        $basket->products()->attach($product->id, ['amount' => $amount]);
    }

    /**
     * @param ShoppingBasket $basket
     * @param Product $product
     * @param int $amount
     */
    public function setProductAmount(ShoppingBasket $basket, Product $product, int $amount = 1)
    {
        if ($amount == 0) {
            $this->removeProduct($basket, $product);
            return;
        }

        $existingProductEntry = $this->existingProductEntry($basket, $product);

        if ($existingProductEntry) {
            $basket->products()->updateExistingPivot($product->id, ['amount' => $amount]);
            return;
        }

        $basket->products()->attach($product->id, ['amount' => $amount]);
    }

    /**
     * @param ShoppingBasket $basket
     * @param Product $product
     */
    public function removeProduct(ShoppingBasket $basket, Product $product)
    {
        $basket->products()->detach($product->id);
    }

    /**
     * @param ShoppingBasket $basket
     * @param Product $product
     * @return Product | null
     */
    public function existingProductEntry(ShoppingBasket $basket, Product $product)
    {
        return $basket->products()->where('product_id', $product->id)->where('shopping_basket_id', $basket->id)->first();
    }
}