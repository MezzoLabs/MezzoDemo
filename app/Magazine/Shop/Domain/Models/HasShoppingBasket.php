<?php


namespace App\Magazine\Shop\Domain\Models;


use App\Magazine\Shop\Domain\Repositories\ShoppingBasketRepository;

/**
 * Class HasShoppingBasket
 * @package App\Magazine\Shop\Domain\Models
 *
 * @property \App\ShoppingBasket $shoppingBasket
 */
trait HasShoppingBasket
{
    /**
     * Create a new shopping basket for a user or return the existing one.
     *
     * @return ShoppingBasket
     * @throws \MezzoLabs\Mezzo\Exceptions\RepositoryException
     */
    public function getOrMakeShoppingBasket() : ShoppingBasket
    {
        if ($this->shoppingBasket) {
            return $this->shoppingBasket;
        }

        return ShoppingBasketRepository::instance()->create(['user_id' => $this->id]);
    }
}