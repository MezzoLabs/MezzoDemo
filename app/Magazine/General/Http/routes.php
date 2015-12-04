<?php

return;

use App\Magazine\General\Http\Controllers\MagazineOptionsController;
use MezzoLabs\Mezzo\Core\Routing\ApiRouter;
use MezzoLabs\Mezzo\Core\Routing\CockpitRouter;
use MezzoLabs\Mezzo\Core\Routing\Router;

module_route('General', [], function (Router $router, ApiRouter $api, CockpitRouter $cockpit) {
    $cockpit->post('general/magazine-options', [
        'uses' => '\\' . MagazineOptionsController::class . '@store',
        'as' => 'magazine.options.store'
    ]);
});
