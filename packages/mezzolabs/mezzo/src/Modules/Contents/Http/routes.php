<?php

use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

module_route('Contents', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $api->resource('Content');
    $api->resource('ContentBlock');
    $api->resource('ContentField');

    $typeController = new \MezzoLabs\Mezzo\Modules\Contents\Http\ApiControllers\ContentBlockTypeApiController();
    $api->get('content-block-types', $typeController->qualifiedActionName('index'));
    $api->get('content-block-types/{hash}', $typeController->qualifiedActionName('show'));
    $cockpit->get('content-block-types/{hash}.html', [
        'uses' => '\\' . $typeController->qualifiedActionName('show'),
        'as' => 'contents.block-type.html'
    ]);
});


