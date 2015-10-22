<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Html;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModuleController;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;

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
     * @var ModuleController
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
            throw new ModulePageException('');

        return $this->makeView($this->view, $data);
    }

    /**
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\View
     */
    protected function makeView($view, $data = [])
    {
        return $this->viewFactory()->make($view, $data);
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
     * @return ModuleController
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


}