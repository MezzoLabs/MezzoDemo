<?php


namespace App\Authentication\Social\Providers;


final class FacebookAuthenticator extends SocialAuthenticationProvider
{

    public $name = "facebook";

    /**
     * @return array
     */
    function scopes() : array
    {
        return [];
    }
}