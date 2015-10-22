<?php


namespace MezzoLabs\Mezzo\Core\Routing;


use MezzoLabs\Mezzo\Core\Modularisation\Http\Html\ModulePage;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class Uri
{
    /**
     * Creates the URI for a module action without prefixes.
     *
     * @param ModuleProvider $module
     * @param $controllerName
     * @param $method
     * @return string
     * @throws \MezzoLabs\Mezzo\Exceptions\ModuleControllerException
     */
    public function toModuleAction(ModuleProvider $module, $controllerName, $method)
    {
        $controller = $module->controller($controllerName);

        $controller->hasActionOrFail($method);

        return $this->toModule($module) . '/' . $controller->slug() . '/' . $method;
    }

    /**
     * @param ModuleProvider $module
     * @return string
     */
    public function toModule(ModuleProvider $module)
    {
        return $module->slug();
    }

    public function toModulePage(ModulePage $page)
    {
        return $this->toModuleAction($page->module(), $page->controller(), $page->action());
    }
}