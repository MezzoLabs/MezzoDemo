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
use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;
use MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields;
use MezzoLabs\Mezzo\Modules\Generator\GeneratorModule;

Route::get('/', function () {
    return view('welcome');
});

Route::get('debug/models', function () {
    $relations = mezzo()->reflector()->relationsSchema();


    //$moduleCenter = mezzo()->moduleCenter();

    mezzo_dump(mezzo()->module('sample')->model('tutorial')->schema());

    //return view('debugmodels', ['moduleCenter' => $moduleCenter]);
});

Route::get('debug/generator', function () {
    $generator = GeneratorModule::make();

    $reflector = mezzo()->reflector();

    $traitGenerator = $generator->generatorFactory()->modelTraitGenerator($reflector->modelsSchema());

    mezzo_textdump($traitGenerator->files()->get('/home/vagrant/Code/MezzoDemo/app/Mezzo/Generated/ModelTraits/MezzoTutorial.php')->content());
    //return View::make('modules.generator::test');

    die();
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


Route::controllers([
    'register' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

