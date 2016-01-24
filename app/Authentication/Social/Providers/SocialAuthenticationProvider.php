<?php


namespace App\Authentication\Social\Providers;


use Laravel\Socialite\Contracts\Factory as Socialite;

abstract class SocialAuthenticationProvider
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var Socialite
     */
    private $socialite;

    public function __construct(Socialite $socialite)
    {

        $this->socialite = $socialite;
    }


    /**
     * @return array
     */
    abstract function scopes() : array;

    /**
     *
     */
    public function redirect()
    {
        $socialite = $this->socialiteDriver();

        if ($this->hasScopes()) {
            $socialite = $socialite->scopes($this->scopes());
        }

        return $socialite->redirect();

    }

    public function hasScopes()
    {
        return !empty($this->scopes());
    }

    public function socialiteDriver()
    {
        return $this->socialite->driver($this->name);
    }

    public function handleCallback()
    {
        mezzo_dd($this->userData());
    }

    public function userData()
    {
        return $this->socialiteDriver()->user();
    }


}