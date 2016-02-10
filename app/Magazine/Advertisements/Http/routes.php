<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Advertisements')->generateRoutes();

module_route('Advertisements', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Advertisement');
});


