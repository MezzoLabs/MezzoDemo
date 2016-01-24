<?php

namespace App\Authentication\Social;


use App\Authentication\Social\Providers\FacebookAuthenticator;
use App\Authentication\Social\Providers\GithubAuthenticator;
use App\Authentication\Social\Providers\SocialAuthenticationProvider;
use App\Exceptions\OAuthException;

/**
 * Class SocialAuthenticator
 * @package App\Authentication\Social
 */
class SocialAuthenticator
{
    /**
     * @var array
     */
    public $providers = [
        'github' => GithubAuthenticator::class,
        'facebook' => FacebookAuthenticator::class
    ];


    /**
     * @param $name
     * @return SocialAuthenticationProvider
     * @throws OAuthException
     */
    public function getProvider($name) : SocialAuthenticationProvider
    {
        if (!$this->hasProvider($name)) {
            throw new OAuthException('Provider not found.');
        }

        return $this->makeProvider($name);
    }


    /**
     * @param $name
     * @return SocialAuthenticationProvider
     */
    private function makeProvider($name) : SocialAuthenticationProvider
    {
        return app()->make($this->providers[$name]);
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasProvider($name)
    {
        return isset($this->providers[$name]);
    }


}