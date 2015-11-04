<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('FileManager')->generateRoutes();

module_route('FileManager', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('File');
});


