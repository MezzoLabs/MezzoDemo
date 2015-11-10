<?php


namespace MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Controllers;


use MezzoLabs\Mezzo\Http\Controllers\CockpitController;
use MezzoLabs\Mezzo\Modules\DeveloperDashboard\Http\Pages\DebugPage;

class DebugController extends CockpitController
{
    public function show()
    {
        return $this->page(DebugPage::class, []);
    }
}