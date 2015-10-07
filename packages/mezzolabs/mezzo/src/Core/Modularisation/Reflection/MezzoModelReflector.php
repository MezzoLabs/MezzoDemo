<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;

use App\Tutorial;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Filesystem\ClassFinder;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Database\Reflection\RelationshipReflection;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Schema\ModelSchemas;
use MezzoLabs\Mezzo\Core\Schema\RelationSchemas;
use MezzoLabs\Mezzo\Core\Traits\IsMezzoModel;
use MezzoLabs\Mezzo\Core\Traits\IsShared;

class MezzoModelReflector extends ModelReflector
{
    use IsShared;

    /**
     * @var ModelReflections
     */
    protected $modelReflections;
    /**
     * @var boolean
     */
    protected $booted = false;
    /**
     * @var RelationSchemas
     */
    protected $relationsSchema;
    /**
     * @var ModelSchemas
     */
    protected $modelsSchema;
    /**
     * @var Mezzo
     */
    private $mezzo;
    /**
     * A collection of strings that represent the class names of all models in the app folder.
     *
     * @var Collection
     */
    private $eloquentModels;
    /**
     * A collection of strings that represent the class names of all mezzo models in the app folder.
     *
     * @var Collection
     */
    private $mezzoModels;
    /**
     * @var string class name of the eloquent mode base class
     */
    private $eloquentClass = EloquentModel::class;
    /**
     * @var string class name of the eloquent mode base class
     */
    private $mezzoModelTrait = IsMezzoModel::class;

    /**
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;
    }

    /**
     * Static version of modelReflection($model). Just for your comfort :*
     *
     * @param $model
     * @return ModelReflection
     */
    public static function getReflection($model)
    {
        return mezzo()->reflector()->modelReflection($model);
    }

    /**
     * Load the class names into the fitting collections.
     */
    public function run()
    {
        if ($this->booted) return false;

        $this->eloquentModels = $this->findEloquentModels();
        $this->mezzoModels = $this->findMezzoModels();

        $this->modelReflections = new ModelReflections($this->mezzoModels);

        $this->relationsSchema = $this->buildRelationSchemas();
        $this->modelsSchema = $this->buildModelSchemas();

        $this->booted = true;

    }

    /**
     *  Finds all classes that extend the eloquent model
     *
     * @return Collection
     */
    protected function findEloquentModels()
    {
        return new Collection($this->getChildrenOfClass($this->eloquentClass));
    }

    /**
     * Returns a collection of class names that extend a given class.
     *
     * @param string $parentClass
     * @param $childClasses
     * @return array
     */
    protected function getChildrenOfClass($parentClass, $childClasses = null)
    {
        $children = [];

        //If there is no collection of classes, we will search through all classes
        if ($childClasses == null) $childClasses = $this->classesInAppFolder();

        foreach ($childClasses as $class) {
            if (is_subclass_of($class, $parentClass)) $children[] = $class;
        }

        return $children;
    }

    /**
     * Find all the classes in the app folder.
     *
     * @return array
     */
    private function classesInAppFolder()
    {
        $finder = app()->make(ClassFinder::class);
        return $finder->findClasses(app_path());
    }

    /**
     *  Finds all classes that use the mezzo model trait.
     *
     * @return Collection
     */
    protected function findMezzoModels()
    {
        $classes = $this->getClassesUsingTrait($this->mezzoModelTrait, $this->eloquentModels);
        return new Collection($classes);
    }

    /**
     * @param $traitName
     * @param null $childClasses
     * @return array
     */
    protected function getClassesUsingTrait($traitName, $childClasses = null)
    {
        if ($childClasses == null) $childClasses = $this->classesInAppFolder();

        $usages = [];

        foreach ($childClasses as $class) {
            if ($this->classUsesTrait($class, $traitName)) $usages[] = $class;
        }

        return $usages;
    }

    /**
     * Helper function that checks if a class uses a trait
     *
     * @param $class
     * @param string $trait
     * @param bool $recursively
     * @return bool
     */
    public function classUsesTrait($class, $trait = "", $recursively = true)
    {
        if (empty($trait)) $trait = $this->mezzoModelTrait;

        if ($recursively)
            $usedTraits = trait_uses_recursive($class);
        else
            $usedTraits = class_uses($class);

        return in_array($trait, $usedTraits);
    }

    /**
     * Check the relations after the reflector ran through the models.
     * We have to do this afterwards so we can tell the difference between one to one and one to many relations.
     *
     * @return RelationSchemas
     */
    protected function buildRelationSchemas()
    {
        $relationReflections = $this->relationReflections();

        $relationSchemas = new RelationSchemas();

        $relationReflections->each(
            function (RelationshipReflection $reflection) use ($relationSchemas) {
                $relationSchemas->addRelation($reflection->relationSchema());
            });

        return $relationSchemas;
    }


    /**
     * @return ModelReflections
     */
    public function reflections()
    {
        return $this->modelReflections;
    }

    /**
     * Get the schemas of all models.
     *
     * @return ModelSchemas
     */
    protected function buildModelSchemas()
    {

        $modelReflections = $this->reflections();

        $modelsSchema = new ModelSchemas();

        $modelReflections->each(function (ModelReflection $reflection) use ($modelsSchema) {
            $modelsSchema->addSchema($reflection->schema());
        });

        return $modelsSchema;
    }

    /**
     * @return Collection
     */
    public function eloquentModels()
    {
        return $this->eloquentModels;
    }

    /**
     * @return Collection
     */
    public function mezzoModels()
    {
        return $this->mezzoModels;
    }

    /**
     * @param $class
     * @param bool $recursively
     * @return bool
     */
    public function classUsesMezzoTrait($class, $recursively = true)
    {
        return $this->classUsesTrait($class, $this->mezzoModelTrait, $recursively);
    }

    /**
     * Get the reflection of the given model or create one
     *
     * @param $model
     * @return ModelReflection
     */
    public function modelReflection($model)
    {
        return $this->reflections()->getOrCreate($model);
    }

    /**
     * Check if the model reflector is booted.
     *
     * @return bool
     */
    public function isBooted()
    {
        return $this->booted;
    }

    /**
     * @return RelationSchemas
     */
    public function relationsSchema()
    {
        return $this->relationsSchema;
    }

    /**
     * @return ModelSchemas
     */
    public function modelsSchema()
    {
        return $this->modelsSchema;
    }


}