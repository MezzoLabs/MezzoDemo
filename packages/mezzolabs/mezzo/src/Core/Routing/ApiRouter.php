<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Dingo\Api\Routing\Router as DingoRouter;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\DingoApi;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;
use MezzoLabs\Mezzo\Exceptions\ModuleControllerException;

class ApiRouter
{
    use CanHaveModule, CanHaveGroupedRouter;

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
        return $this->dingoRouter()->patch($uri, $action);
    }

    /**
     * @return DingoRouter
     */
    public function dingoRouter()
    {
        if($this->hasGroupedRouter())
            return $this->groupedRouter;

        return $this->dingoRouter;
    }


    /**
     * @param array $overwriteAttributes
     * @param callable|Closure $callback
     */
    public function group(array $overwriteAttributes, Closure $callback = null)
    {
        $attributes = $this->config->merge($overwriteAttributes)->toArray();

        $this->dingoRouter()->group($attributes, function (DingoRouter $router) use ($callback) {
            $this->setGroupedRouter($router);

            if($callback !== null)
                call_user_func($callback, $this);
        });
    }


    public function moduleAction($controllerAction)
    {
        $this->hasModuleOrFail();

        if (!is_string($controllerAction) || strpos($controllerAction, '@') == -1)
            throw new InvalidArgumentException($controllerAction);

        $parts = explode('@', $controllerAction);

        $controller = $this->module->makeController($parts[0]);
        $method = $parts[1];

        $uri = mezzo()->uri()->toModuleAction($this->module, $controller, $method);

        return $this->get($uri, $controller->qualifiedActionName($method));
    }

    /**
     * @param string $uri
     * @param array|string|callable $action
     * @return mixed
     */
    public function get($uri, $action)
    {
        return $this->dingoRouter()->get($uri, $action);
    }

    /**
     * Creates the restful routes for a certain resource controller.
     *
     * @param $modelName
     * @param string $controllerName
     * @throws ModuleControllerException
     */
    public function resource($modelName, $controllerName = "")
    {
        if (empty($controllerName))
            $controllerName = $modelName . 'ApiController';

        $controller = $this->module->apiResourceController($controllerName);

        $uri = $this->modelUri($controller->model());

        $this->get($uri, $controller->qualifiedActionName('index'));
        $this->get($uri . '/info', $controller->qualifiedActionName('info'));
        $this->get($uri . '/{id}', $controller->qualifiedActionName('show'));
        $this->post($uri, $controller->qualifiedActionName('store'));
        $this->put($uri . '/{id}', $controller->qualifiedActionName('update'));
        $this->delete($uri . '/{id}', $controller->qualifiedActionName('destroy'));
    }

    public function modelUri(ModelReflection $model)
    {
        return camel_to_slug(str_plural($model->name()));
    }

    /**
     * @param string $uri
     * @param array|string|callable $action
     * @return mixed
     */
    public function post($uri, $action)
    {
        return $this->dingoRouter()->post($uri, $action);
    }

    /**
     * @param $uri
     * @param $action
     * @return mixed
     */
    public function put($uri, $action)
    {
        return $this->dingoRouter()->put($uri, $action);
    }

    /**
     * @param $uri
     * @param $action
     * @return mixed
     */
    public function delete($uri, $action)
    {
        return $this->dingoRouter()->delete($uri, $action);
    }

    public function relation($modelName, $relationName, $controllerName = "")
    {
        if (empty($controllerName))
            $controllerName = $modelName . 'ApiController';

        $controller = $this->module->apiResourceController($controllerName);

        $uri = $this->modelUri($controller->model()) . '/' . $relationName;

        $this->get($uri, $controller->qualifiedActionName($relationName . 'Index'));
    }


}