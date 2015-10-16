<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Dingo\Api\Http\Parser\Accept;
use Illuminate\Routing\Router as LaravelRouter;
use MezzoLabs\Mezzo\Exceptions\RoutingException;


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

        $this->readRealApiConfig();

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
        $attributes = array_merge($this->apiConfig, $overwriteAttributes);

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

    public function makeApiRouter()
    {
        $app = app();

        if (!$app['api.router.adapter'])
            throw new RoutingException('Cannot instantiate the ApiRouter, because Dingo is not booted yet.');

        $acceptParser = new Accept($this->apiConfig('vendor'), $this->apiConfig('version'), $this->apiConfig('defaultFormat'));


        return new ApiRouter(
            $app['api.router.adapter'],
            $acceptParser,
            $app['api.exception'],
            $app,
            $this->apiConfig('domain'),
            $this->apiConfig('prefix')
        );
    }



} 