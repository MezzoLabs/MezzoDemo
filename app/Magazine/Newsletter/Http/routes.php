<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Newsletter')->generateRoutes();

module_route('Newsletter', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Campaign');
    $api->resource('NewsletterRecipient');

    $api->action('resendConfirmation', 'NewsletterRecipient', []);
    $api->action('deliver', 'Campaign', []);

});


