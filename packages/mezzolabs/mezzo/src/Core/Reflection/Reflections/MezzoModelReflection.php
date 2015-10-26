<?php


namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;

use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModelIsAlreadyAssociated;

class MezzoModelReflection extends ModelReflection
{
    /**
     * @var ModuleProvider
     */
    private $module;

    /**
     * @param ModuleProvider $module
     * @throws ModelIsAlreadyAssociated
     */
    public function setModule(ModuleProvider $module)
    {
        if ($this->hasModule()) {
            throw new ModelIsAlreadyAssociated($this, $module);
        }

        $this->module = $module;

        $this->module->associateModel($this->modelReflectionSet());
    }

    /**
     * Check if there is a module that wants to use this model.
     * @return bool
     */
    public function hasModule()
    {
        return $this->module != null;
    }

    /**
     * @return ModuleProvider
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * Class name of the reflected eloquent model.
     *
     * @return MezzoEloquentModel
     */
    public function instance()
    {
        return parent::instance();
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return $this->instance()->getTable();
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Annotations\Reader\ModelAnnotations
     */
    public function annotations()
    {
        return mezzo()->makeAnnotationReader()->model($this);
    }
}