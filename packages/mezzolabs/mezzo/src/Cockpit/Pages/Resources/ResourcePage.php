<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\CannotGuessModelException;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;
use MezzoLabs\Mezzo\Http\Pages\ModulePage;

abstract class ResourcePage extends ModulePage
{
    protected static $types = ['create', 'edit', 'index', 'show'];

    /**
     * @var string
     */
    protected $model = "";

    protected $options = [
        'renderedByFrontend' => true,
        'visibleInNaviation' => true
    ];
    /**
     * @var MezzoModelReflection
     */
    private $modelReflection;

    /**
     * @param ModuleProvider $module
     * @throws ModulePageException
     * @internal param array $options
     */
    public function __construct(ModuleProvider $module)
    {
        $this->module = $module;

        if (empty($this->controller))
            $this->controller = $this->guessController();

        parent::__construct($module);


        $this->assertThatPageHasModel();

    }

    /**
     * @return \MezzoLabs\Mezzo\Http\Controllers\ResourceControllerContract
     * @throws \MezzoLabs\Mezzo\Exceptions\ModuleControllerException
     */
    protected function guessController()
    {
        return $this->module()->resourceController($this->model()->name() . 'Controller');
    }

    /**
     * @return MezzoModelReflection
     */
    public function model()
    {
        if (!$this->modelReflection) {
            $this->modelReflection = $this->makeModelReflection();
        }

        return $this->modelReflection;
    }

    /**
     *
     */
    protected function makeModelReflection()
    {
        if (!empty($this->model)) {
            return mezzo()->model($this->model);
        }

        return mezzo()->model($this->guessModel());
    }

    /**
     * If there is no model set as a property for this page, we will try to guess it from the
     * class name of this page.
     *
     * E.g:
     * List<ModelName>Page, Edit<ModelName>Page, List<ModelName>Page.php
     *
     * @return mixed
     * @throws CannotGuessModelException
     */
    protected function guessModel()
    {
        $pageName = strtolower(Singleton::reflection($this)->getShortName());

        $possibleModel = str_replace('page', '', $pageName);
        $possibleModel = str_replace(static::$types, '', $possibleModel);

        if (empty($possibleModel))
            throw new CannotGuessModelException('Cannot guess model for page ' . get_class($this) . '.');

        if (!mezzo()->knowsModel($possibleModel))
            throw new CannotGuessModelException('Cannot guess model for page ' . get_class($this) . '. ' .
                'A model with the name ' . $possibleModel . ' is not reflected');

        return $possibleModel;
    }

    /**
     * @return bool
     * @throws ModulePageException
     */
    protected function assertThatPageHasModel()
    {
        if (!$this->model())
            throw new ModulePageException('Cannot find a model for this resource page.');

        return true;
    }

}