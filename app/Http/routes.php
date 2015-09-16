<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use MezzoLabs\Mezzo\Modules\Generator\GeneratorModule;

Route::get('/', function () {
    return view('welcome');
});

Route::get('debug/models', function () {
    $moduleCenter = mezzo()->moduleCenter();


    return view('debugmodels', ['moduleCenter' => $moduleCenter]);
});

Route::get('debug/generator', function () {
    $generator = mezzo()->moduleCenter()->getModule(GeneratorModule::class);

    //var_dump($generator);
    dd($generator2);


    return view('debugmodels', ['moduleCenter' => $moduleCenter]);
});


Route::controllers([
    'register' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

