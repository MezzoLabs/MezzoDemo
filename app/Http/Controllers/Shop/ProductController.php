<?php


namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Magazine\Shop\Domain\Repositories\ProductRepository;
use App\Magazine\Shop\Http\Requests\AddToBasketRequest;

class ProductController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $products;

    public function __construct(ProductRepository $products)
    {

        $this->products = $products;
    }


    public function index()
    {
        return view('magazine.shop.index')->with('products', \App\Product::paginate(3));
    }

    public function show($id)
    {
        return view('magazine.shop.show')->with('product', $this->products->findOrFail($id));
    }

    public function addToBasket(AddToBasketRequest $request, $id)
    {
        $product = $this->products->findOrFail($id);

        $amount = intval($request->get('amount'));

        \Auth::user()->getOrMakeShoppingBasket()->add($product, $amount);

        return \Redirect::route('shop.products.show', $id)->with('message', 'Added to basket.');
    }

    public function setAmount()
    {

    }
}