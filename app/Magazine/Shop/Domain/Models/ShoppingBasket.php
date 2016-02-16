<?php

namespace App\Magazine\Shop\Domain\Models;

use App\Magazine\Shop\Domain\Repositories\OrderRepository;
use App\Magazine\Shop\Domain\Repositories\ShoppingBasketRepository;
use App\Mezzo\Generated\ModelParents\MezzoShoppingBasket;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MezzoLabs\Mezzo\Exceptions\RepositoryException;

/**
 * Class ShoppingBasket
 * @package App\Magazine\Shop\Domain\Models
 *
 * @method BelongsToMany products
 */
class ShoppingBasket extends MezzoShoppingBasket
{
    /**
     * Add a product to the current shopping basket.
     *
     * @param Product $product
     * @param int $amount
     * @return bool
     */
    public function add(Product $product, $amount = 1)
    {
        return $this->repository()->addProduct($this, $product, $amount);
    }

    /**
     * Create a new order and clear the products in the shopping basket.
     *
     * @return mixed
     */
    public function moveToOrder()
    {
        return OrderRepository::instance()->createFromShoppingBasket($this);
    }

    public function isEmpty()
    {
        return $this->itemsAmount() == 0;
    }

    /**
     * @return ShoppingBasketRepository
     * @throws RepositoryException
     */
    public static function repository()
    {
        return ShoppingBasketRepository::instance();
    }

    public function itemsAmount()
    {
        $amount = 0;
        $this->products->each(function (Product $product) use (&$amount) {
            $amount += $product->getPivotAmount();
        });

        return $amount;
    }

    public function itemsPrice()
    {
        $price = 0;
        $this->products->each(function (Product $product) use (&$price) {
            $price += $product->calculatePivotPrice();
        });

        return $price;
    }

    public function productsPivotArray()
    {
        $array = [];

        foreach ($this->products as $product) {
            $array[$product->id] = $product->pivotArray();
        }

        return $array;
    }

    public function clearProducts()
    {
        return $this->products()->sync([]);
    }




}
