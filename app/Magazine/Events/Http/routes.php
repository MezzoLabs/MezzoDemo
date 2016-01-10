<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Events')->generateRoutes();

module_route('Events', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Event');
    $api->resource('EventVenue');
    $api->resource('EventProvider');

    $api->action('locked', 'Event', ['mode' => 'single']);
    $api->action('lock', 'Event', ['mode' => 'single']);
    $api->action('unlock', 'Event', ['mode' => 'single']);
});


