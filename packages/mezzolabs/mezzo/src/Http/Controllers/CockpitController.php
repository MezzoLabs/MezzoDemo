<?php


namespace MezzoLabs\Mezzo\Http\Controllers;

use MezzoLabs\Mezzo\Http\Responses\ModuleResponseFactory;

abstract class CockpitController extends Controller
{
    /**
     * @return ModuleResponseFactory
     */
    public function response()
    {
        return app(ModuleResponseFactory::class);
    }

}