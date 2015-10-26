<?php

return [
    "hello" => "there",

    "moduleProviders" => [
        \MezzoLabs\Mezzo\Modules\Sample\SampleModule::class,
        \MezzoLabs\Mezzo\Modules\User\UserModule::class,
        \MezzoLabs\Mezzo\Modules\Generator\GeneratorModule::class
    ],

    "api" => [
        'prefix' => 'api',
        'version' => 'v1',
        'vendor' => 'MezzoLabs',
        'debug' => env('APP_DEBUG', false),
        'strict' => true,
        'defaultFormat' => 'json',
        'domain' => null
    ],

    'cockpit' => [
        'prefix' => 'mezzo',
        'namedRouteNamespace' => 'cockpit::'
    ]
];
  