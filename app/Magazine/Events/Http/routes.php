<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Events')->generateRoutes();

module_route('Events', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Event');
    $api->resource('EventVenue');
    $api->resource('EventProvider');

    $cockpit->post('events/event/create', [
        'uses' => 'Controllers\EventController@store',
        'as' => 'event.store'
    ]);

    $cockpit->put('events/event/edit/{id}', [
        'uses' => 'Controllers\EventController@update',
        'as' => 'event.update'
    ]);

    $cockpit->post('events/event-venue/create', [
        'uses' => 'Controllers\EventVenueController@store',
        'as' => 'event_venue.store'
    ]);

    $cockpit->put('events/event-venue/edit/{id}', [
        'uses' => 'Controllers\EventVenueController@update',
        'as' => 'event_venue.update'
    ]);

    $api->action('locked', 'Event', ['mode' => 'single']);
    $api->action('lock', 'Event', ['mode' => 'single']);
});


