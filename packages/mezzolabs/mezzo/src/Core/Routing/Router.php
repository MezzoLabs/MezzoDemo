<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use \Dingo\Api\Routing\Router as DingoRouter;
use Illuminate\Routing\Router as LaravelRouter;


class Router
{
    /**
     * @var RoutesGenerator
     */
    protected $generator;

    /**
     * @var DingoRouter
     */
    protected $dingoRouter;

    /**
     * @var LaravelRouter
     */
    protected $laravelRouter;


    /**
     * @param RoutesGenerator $generator
     * @param LaravelRouter $laravelRouter
     * @param DingoRouter $dingoRouter
     */
    public function __construct(RoutesGenerator $generator, LaravelRouter $laravelRouter, DingoRouter $dingoRouter)
    {
        $this->generator = $generator;
        $this->dingoRouter = $dingoRouter;
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
     * @return DingoRouter
     */
    public function dingoRouter()
    {
        return $this->dingoRouter;
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