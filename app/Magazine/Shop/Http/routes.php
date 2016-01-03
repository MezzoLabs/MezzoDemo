<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

mezzo()->module('Shop')->generateRoutes();

module_route('Shop', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Merchant');
    $api->resource('Product');
    $api->resource('ShoppingBasket');
    $api->resource('Order');

});


