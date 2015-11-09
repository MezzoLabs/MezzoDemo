<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Categories')->generateRoutes();

module_route('Categories', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Category');

    //$api->relation('Category', 'roles');
});


