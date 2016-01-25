<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', 'your-github-app-id'),
        'client_secret' => env('GITHUB_CLIENT_SECRET', 'your-github-app-secret'),
        'redirect' => 'http://mezzo.dev/oauth/callback/github',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', 'your-facebook-app-id'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', 'your-facebook-app-secret'),
        'redirect' => 'http://mezzo.dev/oauth/callback/facebook/',
    ],

];
