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
        return ['email', 'public_profile'];
    }

    public function userData() : array
    {
        $facebookData = $this->socialiteDriver()->user();

        $raw = $facebookData->user;

        return [
            'gender' => ($raw['gender'] == 'male') ? 'm' : 'f',
            'first_name' => $raw['first_name'],
            'last_name' => $raw['last_name'],
            'email' => $raw['email'],
            'password' => '',
            'confirmation_code' => '',
            'confirmed' => true,
            'backend' => 0
        ];
    }
}