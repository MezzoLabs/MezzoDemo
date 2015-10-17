<?php


namespace MezzoLabs\Mezzo\Core\Routing;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

class ModuleRouter
{
    /**
     * @var ModuleProvider
     */
    protected $module;

    /**
     * @param ModuleProvider $module
     */
    public function __construct(ModuleProvider $module)
    {
        $this->module = $module;
    }

    /**
     * @return ModuleProvider
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * Try to include the routes.php inside the Http folder of the module.
     *
     * @throws ModuleControllerException
     */
    public function includeRoutesFile()
    {
        $routesPath = $this->module->path() . '/Http/routes.php';

        if (!file_exists($routesPath))
            throw new ModuleControllerException('Cannot find routes file for module ' .
                $this->module->qualifiedName() . ' - ' . $routesPath);

        $module = $this->module();

        require $routesPath;
    }


}