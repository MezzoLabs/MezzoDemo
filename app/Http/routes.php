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


Route::get('random', function () {
    mezzo_dump((new \MezzoLabs\Mezzo\Modules\Sample\Http\Controllers\TutorialController())->module());

    return str_random(16);
});

Route::get('/test/file', function () {
    return view('debugfile');
});

Route::get('/test/slug', function () {
    $next = \MezzoLabs\Mezzo\Core\Helpers\Slug::findNext('file',
        [

        ]
    );

    mezzo_dd($next);
});

Route::post('test/file', function (\Illuminate\Http\Request $request) {
    $repo = new \MezzoLabs\Mezzo\Modules\FileManager\Domain\Repositories\FileRepository();
    $fileManager = \MezzoLabs\Mezzo\Modules\FileManager\FileManagerModule::make();
    $uploader = $fileManager->uploader();


    $uploader->uploadInput($request);

});

Route::get('debug/tutorial', function () {
    $tutorial = \App\Tutorial::findOrFail(1);

    $repo = new \MezzoLabs\Mezzo\Modules\Sample\Domain\Repositories\TutorialRepository();
    $repo->update(
        [
            'title' => 'Tutorial 1',
            'user_id' => 102,
            'parent_id' => 5,
            'comments' => [
                1, 2, 3
            ]
        ]
        , 1);


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

    $reflectionManager = mezzo()->makeReflectionManager();
    $reflection = $reflectionManager->eloquentReflection('File');
    $schema = $reflection->schema();

    $schemas = new \MezzoLabs\Mezzo\Core\Schema\ModelSchemas();
    $schemas->addSchema($schema);

    $generatorFactory = GeneratorModule::make()->generatorFactory();
    $modelParentGenerator = $generatorFactory->modelParentGenerator($schemas);
    $modelParentGenerator->run();

    //return view('debugmodels', ['generator' => $generator]);
});

Route::get('debug/commands', function () {
    /** @var \MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields $generateForeignFields */


    $generateForeignFields = app()->make(GenerateForeignFields::class);
    $generateForeignFields->setMezzo(mezzo());

    $generateForeignFields->handle();
});

Route::get('debug/migrationGenerator', function () {
    /** @var \MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields $generateForeignFields */

    $generateForeignFields = app()->make(GenerateForeignFields::class);
    $generateForeignFields->setMezzo(mezzo());


    $generateForeignFields->handle();
});

Route::get('debug/annotations', function () {

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

