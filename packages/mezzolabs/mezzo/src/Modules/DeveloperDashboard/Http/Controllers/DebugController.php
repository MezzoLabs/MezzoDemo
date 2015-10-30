<?php


namespace MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitController;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\CommandWrappers\ApiRouteListCommandWrapper;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\CommandWrappers\RouteListCommandWrapper;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Pages\DebugPage;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Pages\RoutesPage;

class DebugController extends CockpitController
{
    public function show()
    {
        $this->data('model', mezzo()->model('Tutorial'));
        return $this->page(DebugPage::class, []);
    }
}