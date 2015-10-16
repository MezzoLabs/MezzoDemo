<?php

use Dingo\Api\Routing\Router;
use MezzoLabs\Mezzo\Core\Routing\Router as MezzoRouter;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\DingoApi;

/*
|--------------------------------------------------------------------------
| Get the Dingo API Wrapper back from the IoC Container
|--------------------------------------------------------------------------
*/
$wrapper = DingoApi::make();
$api = $wrapper->getDingoRouter();

/*
|--------------------------------------------------------------------------
| Set up the API routes for mezzo
|--------------------------------------------------------------------------
|
| Set HTTP Header to
| Accept:  application/vnd.MezzoLabs.v1+json
|
 */

$api->version('v1', function (Router $api)  {
    $api->get('test', 'App\Http\Controllers\TestController@sayHi');

    //$mezzoRouter->generator()->run($api);
});

