<?php


namespace App\Authentication\Social\Providers;


final class GithubAuthenticator extends SocialAuthenticationProvider
{

    public $name = "github";

    /**
     * @return array
     */
    function scopes() : array
    {
        return [];
    }

    public function userData() : array
    {
        return [];
    }
}