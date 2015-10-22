<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ResourceController;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\NamingConventionException;

class NamingConvention
{
    /**
     * @param $object
     * @return ModuleProvider
     * @throws NamingConventionException
     */
    public static function findModule($object)
    {
        if ($object instanceof ModuleController)
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

        if (!$moduleNamespaceEnd)
            $moduleNamespaceEnd = strpos($controllerClass, 'Http\ApiControllers');

        if (!$moduleNamespaceEnd)
            throw new NamingConventionException("This module controller isn't located inside a real module. " .
                "Check if the controller is inside the Http\\Controllers or the ApiControllers Folder.");

        $moduleNamespace = explode('\\', substr($controllerClass, 0, $moduleNamespaceEnd - 1));
        $moduleKey = $moduleNamespace[count($moduleNamespace) - 1];

        return mezzo()->module($moduleKey);
    }

    /**
     * Try to find the model that is connected via the naming.
     * <ModelName>Controller
     * <ModelName>ApiController
     * <ModelName>Repository
     * ...
     *
     * @param $object
     * @return mixed
     * @throws NamingConventionException
     */
    public static function modelName($object)
    {
        if ($object instanceof ResourceController)
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

    /**
     * @param ResourceController $object
     * @return mixed
     */
    private static function modelNameForModuleController(ResourceController $object)
    {
        $shortName = Singleton::reflection($object)->getShortName();

        $possibleModelName = str_replace(['ApiController', 'Controller'], '', $shortName);

        return $possibleModelName;
    }

    /**
     * Get the full controller class via the module and the name of the controller.
     *
     * @param ModuleProvider $module
     * @param $controllerName
     * @return string
     * @throws NamingConventionException
     */
    public static function controllerClass(ModuleProvider $module, $controllerName)
    {
        if (is_object($controllerName))
            $controllerName = get_class($controllerName);

        if (!strpos($controllerName, 'Controller'))
            $controllerName .= 'Controller';

        /**
         * Get the correct namespace depending on the type of the controller.
         */
        $controllerType = static::controllerType($controllerName);
        if ($controllerType == 'api')
            $controllerNamespace = $module->getNamespaceName() . '\\Http\\ApiControllers\\';
        else
            $controllerNamespace = $module->getNamespaceName() . '\\Http\\Controllers\\';

        /**
         * Check if controllerName exists and if it is inside the correct namespace
         */
        if (class_exists($controllerName) && strpos($controllerName, $controllerNamespace) !== -1)
            return $controllerName;

        /**
         * Check if controllerName is just the class name of the controller and prepend the correct namespace.
         */
        $longControllerName = $controllerNamespace . $controllerName;

        if (class_exists($longControllerName))
            return $longControllerName;

        throw new NamingConventionException('Module controller "' . $longControllerName . '"' .
            ' not found for "' . $module->qualifiedName() . '".');
    }

    /**
     * Determine the type of the controller based on his short class name.
     *
     * @param $controllerName
     * @return string
     */
    public static function controllerType($controllerName)
    {
        if (is_object($controllerName)) {
            $controllerName = get_class($controllerName);
        }

        $nameParts = explode('\\', $controllerName);
        $controllerName = $nameParts[count($nameParts) - 1];

        $isApi = ends_with($controllerName, 'ApiController');

        return ($isApi) ? 'api' : 'html';
    }

    public static function findPageClass(ModuleProvider $module, $name)
    {
        if (!is_string($name))
            throw new InvalidArgumentException($name);

        $namespace = $module->getNamespaceName();

        $possibleClass = $namespace . '\Http\Pages\\' . $name;

        if (!class_exists($possibleClass))
            throw new NamingConventionException('No page found with the name ' . $name . ' tried ' . $possibleClass);

        return $possibleClass;
    }

}