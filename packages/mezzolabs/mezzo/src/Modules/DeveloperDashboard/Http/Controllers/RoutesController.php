<?php


namespace MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitController;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\CommandWrappers\RouteListCommandWrapper;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Pages\RoutesPage;

class RoutesController extends CockpitController
{
    public function showList()
    {
        $applicationRoutes = RouteListCommandWrapper::make()->getApplicationRoutes();

        return $this->page(RoutesPage::class, [
            'applicationRoutes' => $applicationRoutes,
            'apiRoutes' => []
        ]);

    }
}