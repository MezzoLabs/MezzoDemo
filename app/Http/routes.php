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
use MezzoLabs\Mezzo\Modules\Contents\BlockTypes\ContentBlockTypeRegistrar;
use MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields;
use MezzoLabs\Mezzo\Modules\Generator\GeneratorModule;

Route::get('/', function () {
    return view('welcome');
});


Route::get('random', function () {
    mezzo_dump((new \MezzoLabs\Mezzo\Modules\Sample\Http\Controllers\TutorialController())->module());

    return str_random(16);
});

Route::get('/test/contents', function () {
    $blockRegistrar = ContentBlockTypeRegistrar::make();

    return view('debugcontents', ['blocks' => $blockRegistrar->all()]);
});

Route::post('/test/file', 'TestController@uploadFile');


Route::get('/test/relations', function () {
    $reflection = mezzo()->model(\App\CategoryGroup::class, 'eloquent');


    mezzo_dump($reflection->relations());
    mezzo_dd($reflection->relationshipReflections());


});

Route::get('/test/category', function () {
    $seeder = app(CategoryTableSeeder::class);

    $seeder->run();

});

Route::get('/test/tutorial', function () {
    $tutorial = new Tutorial();

    $tutorial->title = str_random();
    $tutorial->body = str_random();
    $tutorial->user_id = 1;

    $tutorial->save();

    $dispatcher = app(Illuminate\Events\Dispatcher::class);

    mezzo_dd($dispatcher);
});


Route::post('test/file/{id}', 'TestController@updateFile');

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

