<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Dingo\Api\Routing\Router as DingoRouter;
use Illuminate\Routing\Router as LaravelRouter;


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
     * @var array
     */
    protected $apiGroupAttributes = [
        "version" => "1",
        "prefix" => "mezzo",
        "vendor" => "MezzoLabs",
        'debug' => false,
        'strict' => true
    ];


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


        $this->readApiGroupAttributesFromConfig();

    }

    /**
     * Read the dingo api configuration from the mezzo config file.
     */
    protected function readApiGroupAttributesFromConfig()
    {
        foreach ($this->apiGroupAttributes as $key => $default) {
            $this->apiGroupAttributes[$key] = mezzo()->config('api.' . $key, $default);
        }
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

    public function api(Closure $callback, $overwriteAttributes = [])
    {
        $attributes = array_merge($this->apiGroupAttributes, $overwriteAttributes);

        $this->apiRouter->group($attributes, $callback);
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

} 