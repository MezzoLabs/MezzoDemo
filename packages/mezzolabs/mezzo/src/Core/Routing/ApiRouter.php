<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Dingo\Api\Routing\Router as DingoRouter;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ResourceController;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\DingoApi;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;
use MezzoLabs\Mezzo\Exceptions\ModuleNotFound;

class ApiRouter
{
    /**
     * @var ApiConfig
     */
    protected $config;

    /**
     * @var DingoRouter
     */
    private $dingoRouter;

    /**
     * @throws \MezzoLabs\Mezzo\Exceptions\RoutingException
     */
    public function __construct()
    {
        $this->dingoRouter = DingoApi::make()->getDingoRouter();
        $this->config = $this->makeApiConfig();
    }

    /**
     * @return ApiConfig
     */
    protected static function makeApiConfig()
    {
        return mezzo()->make(ApiConfig::class);
    }

    /**
     * @param $uri
     * @param $action
     * @return mixed
     */
    public function patch($uri, $action)
    {
        return $this->dingoRouter->patch($uri, $action);
    }

    /**
     * @return DingoRouter
     */
    public function getDingoRouter()
    {
        return $this->dingoRouter;
    }

    public function api(Closure $callback, $overwriteAttributes = [])
    {
        $attributes = $this->config->merge($overwriteAttributes)->toArray();

        $this->group($attributes, $callback);
    }

    /**
     * @param array $attributes
     * @param callable $callback
     */
    public function group(array $attributes, $callback)
    {
        $this->dingoRouter->group($attributes, function (DingoRouter $api) use ($callback) {
            call_user_func($callback, $this);
        });
    }

    public function moduleAction($moduleName, $controllerAction)
    {
        if (!is_string($controllerAction) || strpos($controllerAction, '@') == -1)
            throw new InvalidArgumentException($controllerAction);

        $parts = explode('@', $controllerAction);

        $module = mezzo()->module($moduleName);

        if (!$module) throw new ModuleNotFound($moduleName);

        $controller = $module->controller($parts[0]);
        $method = $parts[1];

        $uri = mezzo_route()->moduleActionUri($module, $controller, $method);

        return $this->get($uri, $controller->qualifiedActionName($method));
    }

    /**
     * @param string $uri
     * @param array|string|callable $action
     * @return mixed
     */
    public function get($uri, $action)
    {
        return $this->dingoRouter->get($uri, $action);
    }

    /**
     * Creates the restful routes for a certain resource controller.
     *
     * @param $moduleName
     * @param $modelName
     * @param string $controllerName
     * @throws ModuleControllerException
     */
    public function resource($moduleName, $modelName, $controllerName = "")
    {
        if (empty($controllerName))
            $controllerName = $modelName . 'Controller';

        $controller = $this->getResourceController($moduleName, $controllerName);

        $uri = $this->modelUri($controller->model());

        $this->get($uri, $controller->qualifiedActionName('index'));
        $this->get($uri . '/{id}', $controller->qualifiedActionName('show'));
        $this->post($uri, $controller->qualifiedActionName('store'));
        $this->put($uri . '/{id}', $controller->qualifiedActionName('update'));
        $this->delete($uri . '/{id}', $controller->qualifiedActionName('destroy'));
    }

    /**
     * @param $moduleName
     * @param $controllerName
     * @return ResourceController|ModuleController
     * @throws InvalidArgumentException
     * @throws ModuleControllerException
     */
    protected function getResourceController($moduleName, $controllerName)
    {

        $controller = mezzo()->module($moduleName)->controller($controllerName);

        if (!$controller->isResourceController())
            throw new ModuleControllerException($controller->qualifiedName() . ' is not a valid resource controller.');

        return $controller;
    }

    public function modelUri(ModelReflection $model)
    {
        return snake_case(str_plural($model->name()));
    }

    /**
     * @param string $uri
     * @param array|string|callable $action
     * @return mixed
     */
    public function post($uri, $action)
    {
        return $this->dingoRouter->post($uri, $action);
    }

    /**
     * @param $uri
     * @param $action
     * @return mixed
     */
    public function put($uri, $action)
    {
        return $this->dingoRouter->put($uri, $action);
    }

    /**
     * @param $uri
     * @param $action
     * @return mixed
     */
    public function delete($uri, $action)
    {
        return $this->dingoRouter->delete($uri, $action);
    }
}