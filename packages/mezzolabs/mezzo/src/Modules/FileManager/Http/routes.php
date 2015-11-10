<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

$fileManager = mezzo()->module('FileManager');

$fileManager->generateRoutes();

module_route('FileManager', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {

    $file = mezzo()->model('File');
    $fileManager = $router->getModule();
    $controller = $fileManager->apiResourceController('FileApiController');
    $api->post($api->modelUri($file) . '/upload', $controller->qualifiedActionName('upload'));

    $api->resource('File');

});


