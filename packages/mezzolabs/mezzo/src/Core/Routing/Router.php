<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Dingo\Api\Http\Parser\Accept;
use Illuminate\Routing\Router as LaravelRouter;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\RoutingException;
use MezzoLabs\Mezzo\Http\Middleware\MezzoMiddleware;


class Router
{
    /**
     * @var RoutesGenerator
     */
    protected $generator;

    /**
     * @var ApiRouter
     */
    protected $apiRouter;

    /**
     * @var LaravelRouter
     */
    protected $laravelRouter;


    /**
     * @param RoutesGenerator $generator
     * @param LaravelRouter $laravelRouter
     * @param ApiRouter $apiRouter
     */
    public function __construct(RoutesGenerator $generator, LaravelRouter $laravelRouter, ApiRouter $apiRouter)
    {
        $this->generator = $generator;
        $this->apiRouter = $apiRouter;
        $this->laravelRouter = $laravelRouter;
    }

    /**
     * Return the singleton instance
     *
     * @return Router
     */
    public static function make()
    {
        return mezzo()->make(static::class);
    }

    /**
     * @param Closure $callback
     * @param array $overwriteAttributes
     * @internal param ModuleProvider $module
     */
    public function api(Closure $callback, $overwriteAttributes = [])
    {
        $this->apiRouter->api($callback, $overwriteAttributes);
    }

    /**
     * @return ApiRouter
     */
    public function apiRouter()
    {
        return $this->apiRouter;
    }

    /**
     * @return LaravelRouter
     */
    public function laravelRouter()
    {
        return $this->laravelRouter;
    }

    /**
     * @return RoutesGenerator
     */
    public function generator()
    {
        return $this->generator;
    }

    /**
     * @param ModuleProvider $module
     * @return string
     */
    public function moduleUri(ModuleProvider $module)
    {
        return $module->slug();
    }

    /**
     * Creates the URI for a module action without prefixes.
     *
     * @param ModuleProvider $module
     * @param $controllerName
     * @param $method
     * @return string
     * @throws \MezzoLabs\Mezzo\Exceptions\ModuleControllerException
     */
    public function moduleActionUri(ModuleProvider $module, $controllerName, $method)
    {
        $controller = $module->controller($controllerName);

        $controller->hasActionOrFail($method);

        return $this->moduleUri($module) . '/' . $controller->slug() . '/' . $method;
    }

    /**
     * Add a named middleware to the routes.
     *
     * @param MezzoMiddleware $mezzoMiddleware
     */
    public function middleware(MezzoMiddleware $mezzoMiddleware)
    {
        $this->laravelRouter()->middleware($mezzoMiddleware->key(), get_class($mezzoMiddleware));
    }





} 