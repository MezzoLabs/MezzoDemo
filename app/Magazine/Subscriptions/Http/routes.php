<?php


use App\Magazine\Subscriptions\Http\Pages\UserSubscriptionsPage;
use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

module_route('User', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Subscription', \App\Magazine\Subscriptions\Http\ApiControllers\SubscriptionsApiController::class);

    $cockpit->page(UserSubscriptionsPage::class);

    $api->relation('User', 'subscriptions', \App\Magazine\Subscriptions\Http\ApiControllers\UserSubscriptionsApiController::class);
});
