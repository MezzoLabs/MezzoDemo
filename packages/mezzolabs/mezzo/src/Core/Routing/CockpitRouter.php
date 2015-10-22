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
        $namespace = $this->module->getNamespaceName() . '\Http';
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
        $this->readConfig();

        $attributes = $this->attributes->merge($overwriteAttributes);

        $this->laravelRouter()->group($attributes->toArray(), function(LaravelRouter $router) use ($callback){
            $this->setGroupedRouter($router);

            if($callback !== null)
                call_user_func($callback, $this);
        });
    }


    /**
     * @param $modelName
     * @param array $pageTypes
     */
    public function resourcePages($modelName, $pageTypes = ['create', 'edit', 'index', 'show'])
    {
        foreach ($pageTypes as $pageType) {
            $pageName = ucfirst($pageType) . ucfirst($modelName) . 'Page';
            $this->page($pageName);
        }
    }

    public function page($pageName)
    {
        $page = $this->module->page($pageName);

        $this->get(mezzo()->uri()->toModulePage($page), $page->qualifiedActionName());
    }

    /**
     * @param $uri
     * @param $action
     * @return \Illuminate\Routing\Route
     */
    public function get($uri, $action)
    {
        $action = $this->controllerAction($action);

        return $this->laravelRouter()->get($uri, $action);
    }

    protected function controllerAction($action)
    {
        $namespace = $this->controllerNamespace();

        return str_replace($namespace . '\\', '', $action);
    }

    public function controllerNamespace()
    {
        return $this->lastGroupStack()->get('namespace', '');
    }

    /**
     * @return Collection
     */
    public function lastGroupStack()
    {
        if (!empty($this->laravelRouter()->getGroupStack())) {
            $groupStack = $this->laravelRouter()->getGroupStack();
            return new Collection(end($groupStack));
        }

        return new Collection();
    }

}