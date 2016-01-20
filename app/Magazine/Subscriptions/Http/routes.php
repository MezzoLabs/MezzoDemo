<?php


use App\Magazine\General\Http\Controllers\MagazineOptionsController;
use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

module_route('User', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Subscription', \App\Magazine\Subscriptions\Http\ApiControllers\SubscriptionsApiController::class);
});
