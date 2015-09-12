<?php

return [
    "hello" => "there",

    "moduleProviders" => [
        \MezzoLabs\Mezzo\Modules\SampleModule\SampleModule::class
    ],

    "api" => [
        'prefix' => 'api',
        'version' => '1',
        'vendor' => 'MezzoLabs',
        'debug' => env('APP_DEBUG', false),
        'strict' => true
    ]
];
  