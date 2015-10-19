<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Http;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
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
    private $options;

    /**
     * Create a new module page.
     *
     * @param ModuleProvider $moduleProvider
     */
    public function __construct(ModuleProvider $moduleProvider, $options = [])
    {
        $this->module = $moduleProvider;
        $this->options = new Collection($options);
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
}