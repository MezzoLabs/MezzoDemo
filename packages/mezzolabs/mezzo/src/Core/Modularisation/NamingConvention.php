<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Http\Html\ModuleResourceController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Exceptions\NamingConventionException;

class NamingConvention
{
    /**
     * @param $object
     * @return ModuleProvider
     * @throws NamingConventionException
     */
    public static function findModule($object){
        if($object instanceof ModuleController)
            return static::findModuleOfController($object);

        throw new NamingConventionException('Cannot find module for ' . get_class($object));
    }

    /**
     * @param ModuleController $controller
     * @return ModuleProvider
     * @throws NamingConventionException
     */
    protected static function findModuleOfController(ModuleController $controller)
    {
        $controllerClass = get_class($controller);
        $moduleNamespaceEnd = strpos($controllerClass, 'Http\Controllers');

        if($moduleNamespaceEnd === -1)
            throw new NamingConventionException("This module controller isn't located inside a real module. " .
                "Check if the controller is inside the Http\\Controlelrs Folder.");

        $moduleNamespace = explode('\\', substr($controllerClass, 0, $moduleNamespaceEnd - 1));
        $moduleKey = $moduleNamespace[count($moduleNamespace) - 1];

        return mezzo()->module($moduleKey);
    }

    public static function modelName($object)
    {
        if($object instanceof ModuleResourceController)
            return static::modelNameForModuleController($object);

        throw new NamingConventionException('Cannot find model name for ' . get_class($object));
    }

    /**
     * Try to find a concrete repository implementation for a model class.
     *
     * @param $modelName
     * @param array $namespaces
     * @return bool|string
     */
    public static function repositoryClass($modelName, $namespaces = ['App'])
    {
        foreach ($namespaces as $namespace) {
            $possibleRepository = $namespace . '\Domain\Repositories\\' . $modelName . 'Repository';

            if (class_exists($possibleRepository))
                return $possibleRepository;
        }

        return false;
    }

    private static function modelNameForModuleController(ModuleResourceController $object)
    {
        $shortName = Singleton::reflection($object)->getShortName();

        $possibleModelName = str_replace('Controller', '', $shortName);

        return $possibleModelName;
    }

}