<?php


namespace MezzoLabs\Mezzo\Core\Reflection\Reflections;

use Illuminate\Database\Eloquent\Relations\Relation as EloquentRelation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as EloquentBelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany as EloquentHasOneOrMany;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoEloquentModel;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModelIsAlreadyAssociated;
use MezzoLabs\Mezzo\Exceptions\ReflectionException;

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
     *
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

    /**
     * @param $relationName
     * @return EloquentBelongsToMany|EloquentHasOneOrMany|EloquentRelation
     * @throws ReflectionException
     */
    public function relation($relationName)
    {
        $hasRelation = method_exists($this->instance(), $relationName);

        if(!$hasRelation)
            throw new ReflectionException('The Model ' . $this->name() . " doesn't has a relation named " . $relationName);

        $relation = $this->instance()->$relationName();

        if($relation instanceof EloquentRelation)
            throw new ReflectionException($relationName . ' is not a valid Eloquent reflection.');

        return $relation;
    }
}