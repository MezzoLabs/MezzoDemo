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


use App\Tutorial;
use App\User;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\FileCacheReader;
use MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields;
use MezzoLabs\Mezzo\Modules\Generator\GeneratorModule;

Route::get('/', function () {
        return view('welcome');
});


Route::get('random',function(){
    mezzo_dump((new \MezzoLabs\Mezzo\Modules\Sample\Http\Controllers\TutorialController())->module());

   return str_random(16);
});

Route::get('debug/tutorial', function () {
    $tutorial = \App\Tutorial::findOrFail(1);
    mezzo_dd($tutorial->first());
    echo "hi";
});

Route::get('debug/rules', function () {
    $rules = new \MezzoLabs\Mezzo\Core\Schema\ValidationRules\Rules();
    $rules->addRulesFromString('required|email|between:5,255|unique:users');

    mezzo_dd($rules);
});


Route::get('debug/models', function () {
    $moduleCenter = mezzo()->moduleCenter();

    $module = mezzo()->module('sample');

    $controller = new \MezzoLabs\Mezzo\Modules\Sample\Http\Controllers\TutorialController();
    $controller->repository();

    //return view('debugmodels', ['moduleCenter' => $moduleCenter]);
});

Route::any('debug/controller', 'TestController@foo');

Route::get('debug/generator', function () {

    $generator = GeneratorModule::make();

    $reflector = mezzo()->reflector();

    $traitGenerator = $generator->generatorFactory()->modelTraitGenerator($reflector->modelSchemas());

    $traitGenerator->run();

    //return view('debugmodels', ['generator' => $generator]);
});

Route::get('debug/commands', function(){
    /** @var \MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields $generateForeignFields */


    $generateForeignFields = app()->make(GenerateForeignFields::class);
    $generateForeignFields->setMezzo(mezzo());

    $generateForeignFields->handle();
});

Route::get('debug/migrationGenerator', function(){
    /** @var \MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields $generateForeignFields */

    $generateForeignFields = app()->make(GenerateForeignFields::class);
    $generateForeignFields->setMezzo(mezzo());


    $generateForeignFields->handle();
});

Route::get('debug/annotations', function(){

    $reader = new FileCacheReader(
        new AnnotationReader(),
        storage_path('app/') . 'doctrineAnnotationsTest',
        $debug = true
    );

    $property = new ReflectionProperty(Tutorial::class, 'email');
    //dd($property);

    $annotations = $reader->getPropertyAnnotations($property);

    mezzo_dd($annotations);
});


Route::controllers([
    'register' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

