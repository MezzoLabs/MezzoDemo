<?php


namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;

class FrontendComposer
{
    /**
     * @var \App\User|null
     */
    protected $user;

    /**
     * Create a new frontend composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = \Auth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('auth_user', $this->user);
        $view->with('auth_shopping_basket', ($this->user) ? $this->user->getOrMakeShoppingBasket() : null);
    }
}