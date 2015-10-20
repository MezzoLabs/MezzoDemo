<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Resources;


use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Modularisation\Http\ModulePage;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Exceptions\CannotGuessModelException;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;

abstract class ResourcePage extends ModulePage
{
    /**
     * @var string
     */
    protected $model = "";

    /**
     * @var MezzoModelReflection
     */
    private $modelReflection;

    /**
     * @param ModuleProvider $moduleProvider
     * @param array $options
     */
    public function __construct(ModuleProvider $moduleProvider, $options = [])
    {
        parent::__construct($moduleProvider, $options);

        $this->assertThatPageHasModel();

    }

    /**
     * @return bool
     * @throws ModulePageException
     */
    protected function assertThatPageHasModel()
    {
        if(!$this->model())
            throw new ModulePageException('Cannot find a model for this resource page.');

        return true;
    }

    /**
     * @return MezzoModelReflection
     */
    protected function model()
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
        if (!empty($this->mode)) {
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
        $pageTypes = ['add', 'edit', 'list'];

        $pageName = strtolower(Singleton::reflection($this)->getShortName());

        $possibleModel = str_replace('page', '', $pageName);
        $possibleModel = str_replace($pageTypes, '', $possibleModel);

        if(empty($possibleModel))
            throw new CannotGuessModelException('Cannot guess model for page ' . get_class($this) . '.');

        if(!mezzo()->knowsModel($possibleModel))
            throw new CannotGuessModelException('Cannot guess model for page ' . get_class($this) . '. ' .
                'A model with the name ' . $possibleModel . ' is not reflected');

        return $possibleModel;
    }

}