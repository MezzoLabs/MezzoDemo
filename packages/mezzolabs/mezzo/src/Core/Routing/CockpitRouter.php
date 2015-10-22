<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Illuminate\Routing\Router as LaravelRouter;
use Illuminate\Support\Collection;


class CockpitRouter
{
    use CanHaveModule, CanHaveGroupedRouter;

    /**
     * @var LaravelRouter
     */
    protected $laravelRouter;

    /**
     * @var Collection
     */
    protected $attributes;


    /**
     * @param LaravelRouter $laravelRouter
     */
    public function __construct(LaravelRouter $laravelRouter)
    {
        $this->laravelRouter = $laravelRouter;

        $this->readConfig();
    }

    private function readConfig()
    {
        $cockpitConfig = mezzo()->config('cockpit');

        $this->attributes = new Collection([
            'prefix' => $cockpitConfig['prefix'],
            'as' => $cockpitConfig['namedRouteNamespace'],
        ]);

        if ($this->hasModule())
            $this->setDefaultControllerNamespace();
    }

    private function setDefaultControllerNamespace()
    {
        $namespace = $this->module->getNamespaceName() . '\Http\Controllers';
        $this->attributes->put('namespace', $namespace);
    }

    /**
     * @return LaravelRouter
     */
    public function laravelRouter()
    {
        if($this->hasGroupedRouter())
            return $this->groupedRouter;

        return $this->laravelRouter;
    }

    /**
     * @param $overwriteAttributes
     * @param Closure $callback
     */
    public function group($overwriteAttributes, Closure $callback = null)
    {
        $attributes = $this->attributes->merge($overwriteAttributes);

        $this->laravelRouter()->group($attributes->toArray(), function(LaravelRouter $router) use ($callback){
            $this->setGroupedRouter($router);

            if($callback !== null)
                call_user_func($callback, $this);
        });
    }

}