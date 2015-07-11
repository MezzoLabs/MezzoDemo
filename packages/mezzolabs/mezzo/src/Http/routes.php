<?php

/*
|--------------------------------------------------------------------------
| Get the Dingo API Wrapper back from the IoC Container
|--------------------------------------------------------------------------
*/
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\DingoApi;
$wrapper = DingoApi::make();
$api = $wrapper->getApi();

/*
|--------------------------------------------------------------------------
| Set up the API routes for mezzo
|--------------------------------------------------------------------------
|
| Set HTTP Header to
| Accept:  application/vnd.MezzoLabs.v1+json
|
 */
$api->version('v1', function ($api) {
    $api->get('test', 'App\Http\Controllers\TestController@sayHi');
});