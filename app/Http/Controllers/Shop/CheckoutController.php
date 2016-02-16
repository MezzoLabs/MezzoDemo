<?php


namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {

        //TODO:ss Add steps: Ask for address -> Ask for payment method -> Review order -> *Checkout* -> Success

        $cart = $this->userOrFail()->getOrMakeShoppingBasket();

        if ($cart->isEmpty()) {
            return \Redirect::back()->with('error', 'Cannot check out an empty shopping cart.');
        }

        $order = $cart->moveToOrder();

        $cart->clearProducts();


        return \Redirect::to('/')->with('message', 'Thank you for shopping with us.');

    }
}