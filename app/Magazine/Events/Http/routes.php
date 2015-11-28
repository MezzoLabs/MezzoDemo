<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Events')->generateRoutes();

module_route('Events', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Event');

    $cockpit->post('events/event/create', [
        'uses' => 'Controllers\EventController@store',
        'as' => 'event.store'
    ]);

    $cockpit->put('events/event/edit/{id}', [
        'uses' => 'Controllers\EventController@update',
        'as' => 'event.update'
    ]);
});


