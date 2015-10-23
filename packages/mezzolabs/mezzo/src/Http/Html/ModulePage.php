<?php

namespace MezzoLabs\Mezzo\Http\Html;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Cockpit\Pages\Resources\ResourcePage;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;
use MezzoLabs\Mezzo\Http\Controller;

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
     * The short name of this page.
     *
     * @var string
     */
    private $name;

    /**
     * @var Collection
     */
    private $parameters;

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
     * @var string The controller method that shows this page.
     */
    protected $action;

    /**
     * Create a new module page.
     *
     * @param ModuleProvider $module
     */
    public function __construct(ModuleProvider $module)
    {
        $this->module = $module;

        $this->validate();
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

        return $this->makeView($this->view, $data);
    }

    /**
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\View
     */
    protected function makeView($view, $data = [])
    {
        $allData = $this->additionalData()->merge($data);

        if (class_exists(\Debugbar::class))
            \Debugbar::disable();

        return $this->viewFactory()->make($view, $allData->toArray());
    }

    /**
     * @return Collection
     */
    protected function additionalData()
    {
        $additionalData = new Collection();

        if ($this instanceof ResourcePage)
            $additionalData->put('model', $this->model());

        return $additionalData;
    }

    /**
     * @return \Illuminate\View\Factory
     */
    protected function viewFactory()
    {
        return mezzo()->makeViewFactory();
    }

    public function title()
    {
        if (!$this->title) {
            $this->title = $this->name();
        }

        return $this->title;
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
    final public function qualifiedName()
    {
        return $this->module()->qualifiedName() . '.' . $this->name();
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
    final public function slug()
    {
        return snake_case($this->name());
    }

    /**
     * @return Collection
     */
    public function getParameters()
    {
        return $this->parameters;
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
     * @return string
     */
    public function action()
    {
        if ($this->action)
            return $this->action;

        return $this->name;
    }

    public function qualifiedActionName()
    {
        return $this->controller()->qualifiedActionName($this->action());
    }

    /**
     * @return bool
     * @throws ModulePageException
     */
    protected function validate()
    {
        if (!$this->controller())
            throw new ModulePageException('There is no controller for ' . $this->qualifiedName());

        $this->controller()->hasActionOrFail($this->action());

        return true;
    }

    public function registerRoutes()
    {
        $this->module()->router()->registerPage($this);
    }


}