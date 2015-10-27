<?php


namespace MezzoLabs\Mezzo\Modules\DeveloperDashboard\CommandWrappers;


use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Support\Collection;

class RouteListCommandWrapper extends RouteListCommand
{
    /**
     * @return Collection
     */
    public function getApplicationRoutes()
    {
        return new Collection($this->getRoutes());
    }

    /**
     * @return RouteListCommandWrapper
     */
    public static function make()
    {
        return app(static::class);
    }
}