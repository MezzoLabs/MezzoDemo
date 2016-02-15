<?php


namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Magazine\Shop\Domain\Repositories\ProductRepository;
use App\Magazine\Shop\Domain\Repositories\ShoppingBasketRepository;
use App\Magazine\Shop\Http\Requests\SetProductAmountRequest;

class ShoppingBasketController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $products;

    /**
     * @var ShoppingBasketRepository
     */
    private $baskets;

    public function __construct(ProductRepository $products, ShoppingBasketRepository $baskets)
    {

        $this->products = $products;
        $this->baskets = $baskets;
    }

    public function index()
    {
        return view('magazine.shop.basket')->with('basket', \Auth::user()->getOrMakeShoppingBasket());
    }

    public function setAmount(SetProductAmountRequest $request, $id)
    {
        $product = $this->products->findOrFail($id);

        $this->baskets->setProductAmount(\Auth::user()->getOrMakeShoppingBasket(), $product, $request->get('amount'));

        return \Redirect::route('shop.basket')->withMessage('Basket updated');


    }
}