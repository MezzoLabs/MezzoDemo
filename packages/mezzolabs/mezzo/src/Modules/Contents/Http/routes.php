<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

module_route('Contents', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Content');
    $api->resource('ContentBlock');
    $api->resource('ContentField');
});


