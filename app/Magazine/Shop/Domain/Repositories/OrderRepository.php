<?php


namespace App\Magazine\Shop\Domain\Repositories;


use App\Magazine\Shop\Domain\Models\ShoppingBasket;
use App\Magazine\Shop\Exceptions\NoMerchantFoundException;
use App\Order;
use Illuminate\Database\Eloquent\Collection as ElqouentCollection;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;

class OrderRepository extends ModelRepository
{
    /**
     * @param ShoppingBasket $basket
     * @return Order
     * @throws NoMerchantFoundException
     */
    public function makeFromShoppingBasket(ShoppingBasket $basket) : Order
    {
        $order = new Order();

        $products = $basket->products;

        $pivotRows = $basket->productsPivotArray();

        $products->keyBy('id')->keys();

        $order->user_id = $basket->user_id;
        $order->status = Order::STATE_NEW;
        $order->merchant_id = $this->findMerchantIdFromProducts($products);

        $order->save();

        $order->products()->sync($pivotRows);


        return $order;
    }

    private function findMerchantIdFromProducts(ElqouentCollection $products)
    {
        foreach ($products as $product) {
            if ($product->merchant_id) {
                return $product->merchant_id;
            }
        }

        throw new NoMerchantFoundException('Cannot find a merchant for this shopping cart.');
    }
}