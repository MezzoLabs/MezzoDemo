<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Events')->generateRoutes();

module_route('Events', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Tutorial');
});


