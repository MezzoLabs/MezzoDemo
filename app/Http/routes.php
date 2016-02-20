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
use MezzoLabs\Mezzo\Modules\Generator\Generators\AnnotationGenerator;

Route::get('/', 'StartController@start');

Route::group(['middleware' => ['mezzo.no_permissions_check', 'mezzo.no_model_validation']], function () {
    // Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

    Route::get('register/verify/{confirmationCode}', [
        'as' => 'confirmation_path',
        'uses' => 'Auth\AuthController@confirm'
    ]);

    Route::controllers([
        'register' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

    Route::get('oauth/callback/{provider}', 'Auth\AuthController@oauthCallback');
    Route::get('oauth/redirect/{provider}', 'Auth\AuthController@oauthToProvider');


    Route::group(['prefix' => 'shop'], function () {
        Route::resource('products', 'Shop\ProductController');
    });

});


Route::group(['middleware' => ['auth', 'mezzo.no_permissions_check']], function () {
    Route::get('profile',
        ['uses' => 'ProfileController@profile', 'as' => 'profile']);
    Route::put('profile',
        ['uses' => 'ProfileController@updateUser', 'as' => 'profile.update-user']);

    Route::put('profile',
        ['uses' => 'ProfileController@updatePassword', 'as' => 'profile.update-password']);

    Route::get('profile/address',
        ['uses' => 'ProfileController@getAddress', 'as' => 'profile.address']);
    Route::post('profile/address', 'ProfileController@storeAddress');
    Route::put('profile/address', 'ProfileController@updateAddress');

    Route::get('profile/liked-categories',
        ['uses' => 'ProfileController@getLikedCategories', 'as' => 'profile.liked-categories']);
    Route::post('profile/liked-categories', 'ProfileController@storeLikedCategories');

    Route::get('profile/destroy', 'ProfileController@destroy');

    Route::group(['prefix' => 'shop'], function () {
        Route::post('products/{id}/addToBasket', ['uses' => 'Shop\ProductController@addToBasket', 'as' => 'shop.add_to_basket']);
        Route::get('basket', ['uses' => 'Shop\ShoppingBasketController@index', 'as' => 'shop.basket']);
        Route::get('basket/setAmount/{id}', ['uses' => 'Shop\ShoppingBasketController@setAmount', 'as' => 'shop.set_product_amount']);
        Route::get('checkout', ['uses' => 'Shop\CheckoutController@index', 'as' => 'shop.checkout']);
    });

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::get('', ['uses' => 'PostController@getIndex', 'as' => 'index']);
        Route::get('/{id}', ['uses' => 'PostController@getShow', 'as' => 'show']);
    });


});


/**
 * --------------- Mezzo test area
 */


Route::get('/test/during', function () {
    $from = "18.01.2015 10:00";
    $to = "18.01.2016 12:00";

    mezzo_dump(\App\Event::betweenDates($from, '')->get());
});

Route::get('/test/distance', function () {

    mezzo_dump(\App\Event::nearZip('67105', 200)->get());
});

Route::get('/test/lock', function () {
    $post = \App\Event::first();

    mezzo_dump($post->lock());

    mezzo_dump($post->isLockedForUser());

    //mezzo_dump($post->unlock());
});

Route::get('random', function () {
    mezzo_dump((new \MezzoLabs\Mezzo\Modules\Sample\Http\Controllers\TutorialController())->module());

    return str_random(16);
});

Route::get('/test/options', function () {
    \Auth::user()->touch();

    $optionsService = app(\MezzoLabs\Mezzo\Modules\General\Options\OptionsService::class);

    $optionsService->get('test.test.test', 'something new 2');
    $optionsService->set('test.test.test2', 'something new 2 ' . str_random());

    return "hello";
});

Route::get('/test/categories', function () {
    $categories = \App\Category::inGroup('content')->get();

    mezzo_dd($categories);
});


Route::get('/test/seed', function () {
    $databaseSeeder = new DatabaseSeeder();

    $databaseSeeder->run();
});

Route::get('/test/posts', function () {

    mezzo_dd(\MezzoLabs\Mezzo\Http\Transformers\GenericEloquentModelTransformer::makeBest(\App\Post::first()));
});


Route::get('/test/reflection', function () {
    $reflectionManager = mezzo()->makeReflectionManager();
    $mezzoReflection = $reflectionManager->mezzoReflection('Event');
    $eloquentReflection = $reflectionManager->eloquentReflection('Event');

    mezzo_dd($eloquentReflection->schema()->relationSides());

});

Route::get('/test/events', function () {
    $event = \App\Event::findOrFail(26);

    mezzo_dd($event->start());
    mezzo_dd($event->end());
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


Route::get('debug/generator', function () {

    $annotationGenerator = app()->make(AnnotationGenerator::class);

    $reflectionManager = mezzo()->makeReflectionManager();
    $reflection = $reflectionManager->eloquentReflection('Order');
    //$reflectionMezzo = $reflectionManager->mezzoReflection('Order');
    $schema = $reflection->schema();

    $schemas = new \MezzoLabs\Mezzo\Core\Schema\ModelSchemas();
    $schemas->addSchema($schema);

    $generatorFactory = GeneratorModule::make()->generatorFactory();
    $modelParentGenerator = $generatorFactory->modelParentGenerator($schemas);

    $modelParentSchema = $modelParentGenerator->modelParentSchemas()->first();

    $modelParentGenerator->run();

    //return view('debugmodels', ['generator' => $generator]);
});

Route::get('debug/commands', function () {
    $generateForeignFields = app()->make(GenerateForeignFields::class);
    $generateForeignFields->setMezzo(mezzo());

    $generateForeignFields->handle();
});

Route::get('debug/migrationGenerator', function () {

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

Route::get('seed/posts', function () {
    $postsTableSeeder = app()->make(PostsTableSeeder::class);

    $postsTableSeeder->run();
});

Route::get('test/api/relations', function () {

    $users = app()->make(\MezzoLabs\Mezzo\Modules\User\Domain\Repositories\UserRepository::class);

    $attribute = mezzo()->attribute('User', 'subscriptions');
    $items = $users->relationshipItems(\Auth::user()->subscriptions(), ['*'], new \MezzoLabs\Mezzo\Http\Requests\Queries\QueryObject());


    mezzo_dd($items);
});


Route::get('test/orders', function () {
    $cart = \Auth::user()->getOrMakeShoppingBasket();

    $order = \App\Magazine\Shop\Domain\Repositories\OrderRepository::instance()->createFromShoppingBasket($cart);

    mezzo_dd($order);
});

Route::get('test/imagefiles', function () {
    $image = \App\ImageFile::first();

    mezzo_dd($image->file);
});



