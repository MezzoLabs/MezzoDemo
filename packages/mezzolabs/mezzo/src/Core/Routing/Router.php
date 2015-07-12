<?php


namespace MezzoLabs\Mezzo\Core\Routing;


class Router
{
    /**
     * @var RoutesGenerator
     */
    private $generator;

    /**
     * @param RoutesGenerator $generator
     */
    public function __construct(RoutesGenerator $generator)
    {
        $this->generator = $generator;
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
     * @return RoutesGenerator
     */
    public function generator()
    {
        return $this->generator;
    }

} 