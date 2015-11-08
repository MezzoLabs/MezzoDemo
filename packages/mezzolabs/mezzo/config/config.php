<?php

return [
    "hello" => "there",

    "moduleProviders" => [
        \MezzoLabs\Mezzo\Modules\FileManager\FileManagerModule::class,
        \MezzoLabs\Mezzo\Modules\Sample\SampleModule::class,
        \MezzoLabs\Mezzo\Modules\User\UserModule::class,
        \MezzoLabs\Mezzo\Modules\Generator\GeneratorModule::class,
        \MezzoLabs\Mezzo\Modules\DeveloperDashboard\DeveloperDashboardModule::class,
        \MezzoLabs\Mezzo\Modules\Categories\CategoriesModule::class,
    ],

    "api" => [
        'prefix' => 'api',
        'version' => 'v1',
        'vendor' => 'MezzoLabs',
        'debug' => env('APP_DEBUG', false),
        'strict' => true,
        'defaultFormat' => 'json',
        'domain' => null,
        'formats' => [

            'json' => MezzoLabs\Mezzo\Http\Format\Json::class

        ]
    ],

    'cockpit' => [
        'prefix' => 'mezzo',
        'namedRouteNamespace' => 'cockpit::'
    ],

    'moduleGroups' => [
        'general' => 'General',
        'admin' => 'Admin',
        'development' => 'Development'
    ]
];
  