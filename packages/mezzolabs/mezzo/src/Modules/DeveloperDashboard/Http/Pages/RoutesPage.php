<?php


namespace MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Pages;

use MezzoLabs\Mezzo\Http\Pages\ModulePage;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Controllers\RoutesController;

class RoutesPage extends ModulePage
{
    protected $renderedByFrontend = false;

    protected $controller = RoutesController::class;

    protected $action = 'showList';

    protected $visibleInNavigation = true;

    protected $view = 'modules.developerdashboard::routes';

}