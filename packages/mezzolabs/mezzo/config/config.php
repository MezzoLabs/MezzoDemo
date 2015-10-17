<?php

return [
    "hello" => "there",

    "moduleProviders" => [
        \MezzoLabs\Mezzo\Modules\Sample\SampleModule::class,
        \MezzoLabs\Mezzo\Modules\Generator\GeneratorModule::class
    ],

    "api" => [
        'prefix' => 'mezzo',
        'version' => 'v1',
        'vendor' => 'MezzoLabs',
        'debug' => env('APP_DEBUG', false),
        'strict' => true,
        'defaultFormat' => 'json',
        'domain' => null
    ]
];
  