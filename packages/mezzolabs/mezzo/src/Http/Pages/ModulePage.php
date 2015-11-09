<?php

namespace MezzoLabs\Mezzo\Http\Pages;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ResourcePage;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;
use MezzoLabs\Mezzo\Http\Controllers\Controller;

abstract class ModulePage implements ModulePageContract
{
    /**
     * The title that is displayed in the cockpit sidebar.
     *
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $view;

    /**
     * The module that this page belongs to.
     *
     * @var ModuleProvider
     */
    protected $module;
    /**
     * @var Controller
     */
    protected $controllerObject;
    /**
     * The name of the controller that manages this page.
     *
     * @var string
     */
    protected $controller;
    /**
     *  The controller method that shows this page.
     *
     * @var string
     */
    protected $action;
    /**
     * Options that influence the styling and the routes of this page.
     * They will overwrite the $defaultOptions.
     *
     * @var array|static
     */
    protected $options = [

    ];
    /**
     * The default options that will eventually be overwritten by $options.
     *
     * @var array|Collection
     */
    protected $defaultOptions = [
        /*
         * Should this page be display in the sidebar navigation?
         */
        'visibleInNavigation' => true,
        /*
         * Is this page rendered by a Javascript SPA-Framework like Angular?
         * Then /mezzo/MODULE_NAME/PAGE_ACTION will output the cockpit without any content.
         * mezzo/MODULE_NAME/PAGE_ACTION.html will output the content of this page.
         */
        'renderedByFrontend' => true,
    ];
    /**
     * The short name of this page.
     *
     * @var string
     */
    private $name;

    /**
     * Create a new module page.
     *
     * @param ModuleProvider $module
     */
    public function __construct(ModuleProvider $module)
    {
        $this->module = $module;

        $this->defaultOptions = new Collection($this->defaultOptions);
        $this->options = $this->defaultOptions->merge($this->options);

        $this->validate();
    }

    /**
     * @return bool
     * @throws ModulePageException
     */
    protected function validate()
    {
        if (!$this->controller())
            throw new ModulePageException('There is no controller for ' . $this->qualifiedName());

        if (empty($this->action()))
            throw new ModulePageException('A module page needs a controller action: ' . get_class($this));

        $this->controller()->hasActionOrFail($this->action());

        return true;
    }

    /**
     * @return Controller
     * @throws \MezzoLabs\Mezzo\Exceptions\InvalidArgumentException
     * @throws \MezzoLabs\Mezzo\Exceptions\ModuleControllerException
     */
    public function controller()
    {
        if (!$this->controllerObject)
            $this->controllerObject = $this->module()->makeController($this->controller);

        return $this->controllerObject;
    }

    /**
     * @return ModuleProvider
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * @return string
     */
    final public function qualifiedName()
    {
        return $this->module()->qualifiedName() . '.' . $this->name();
    }

    /**
     * Returns the name of this page.
     *
     * @return string
     */
    final public function name()
    {
        if (!$this->name) {
            $reflection = Singleton::reflection($this);
            $this->name = str_replace('Page', '', $reflection->getShortName());
        }

        return $this->name;
    }

    /**
     * @return string
     */
    public function action()
    {
        if ($this->action)
            return $this->action;

        return $this->name;
    }

    /**
     * Deliver the HTML code to the cockpit.
     *
     * @param array $data
     * @return string
     * @throws ModulePageException
     */
    public function template($data = [])
    {
        if (!$this->view)
            throw new ModulePageException('No view for page.');

        /**
         * Add some additional data to the view data.
         */
        $data = $this->additionalData()->merge($data);

        return $this->makeView($this->view, $data);
    }

    /**
     * @return Collection
     */
    protected function additionalData()
    {
        $additionalData = new Collection();

        if ($this instanceof ResourcePage)
            $additionalData->put('model', $this->model());

        $additionalData->put('module_page', $this);
        $additionalData->put('page_options', $this->options);

        return $additionalData;
    }

    /**
     * @param $view
     * @param array $data
     * @return \Illuminate\View\View
     */
    protected function makeView($view, $data = [])
    {
        if (class_exists(\Debugbar::class))
            \Debugbar::disable();

        if ($data instanceof Collection)
            $data = $this->collectionToArray($data);

        return $this->viewFactory()->make($view, $data);
    }

    protected function collectionToArray(Collection $data)
    {
        $array = [];

        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * @return \Illuminate\View\Factory
     */
    protected function viewFactory()
    {
        return mezzo()->makeViewFactory();
    }

    /**
     * @return boolean
     */
    public function isRenderedByFrontend()
    {
        return $this->options('renderedByFrontend');
    }

    /**
     * @param null $key
     * @param null $value
     * @return Collection
     */
    public function options($key = null, $value = null)
    {
        if (!$key)
            return $this->options;

        if (!$value)
            return $this->options()->get($key);

        return $this->options()->put($key, $value);
    }

    public function title()
    {
        if (!$this->title) {
            $this->title = ucfirst(snake_case($this->name(), ' '));
        }

        return $this->title;
    }

    /**
     * @return string
     */
    final public function slug()
    {
        return snake_case($this->name());
    }

    public function qualifiedActionName()
    {
        return $this->controller()->qualifiedActionName($this->action());
    }

    public function registerRoutes()
    {
        $this->module()->router()->registerPage($this);
    }

    /**
     * @return bool
     */
    public function isVisibleInNavigation()
    {
        return $this->options('visibleInNavigation');
    }

    /**
     * The URI to this module page.
     * /mezzo/<MODULE_NAME>/<CONTROLLER_ACTION_NAME>
     *
     * @return string
     */
    public function uri()
    {
        return mezzo()->uri()->toModulePage($this);
    }

    public function controllerName()
    {
        return $this->controller()->qualifiedName();
    }


}