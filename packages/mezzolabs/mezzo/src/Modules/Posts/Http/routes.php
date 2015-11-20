<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Posts')->generateRoutes();

module_route('Posts', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Post');
});


