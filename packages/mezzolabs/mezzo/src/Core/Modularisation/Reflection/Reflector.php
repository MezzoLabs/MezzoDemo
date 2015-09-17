<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;

use App\Tutorial;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Filesystem\ClassFinder;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Collections\EloquentModels;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflections;
use MezzoLabs\Mezzo\Core\Traits\IsShared;
use MezzoLabs\Mezzo\Core\Traits\MezzoModel;

class Reflector
{

    use IsShared;

    /**
     * @var Mezzo
     */
    private $mezzo;

    /**
     * A collection of strings that represent the class names of all models in the app folder.
     *
     * @var EloquentModels
     */
    private $eloquentModels;

    /**
     * A collection of strings that represent the class names of all mezzo models in the app folder.
     *
     * @var EloquentModels
     */
    private $mezzoModels;

    /**
     * @var string class name of the eloquent mode base class
     */
    private $eloquentClass = EloquentModel::class;

    /**
     * @var string class name of the eloquent mode base class
     */
    private $mezzoModelTrait = MezzoModel::class;

    /**
     * @var ModelReflections
     */
    protected $modelReflections;

    /**
     * @var boolean
     */
    protected $booted = false;

    /**
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;
    }

    /**
     * Load the class names into the fitting collections.
     */
    public function run()
    {
        if ($this->booted) return false;

        $this->eloquentModels = $this->findEloquentModels();
        $this->mezzoModels = $this->findMezzoModels();
        $this->modelReflections = new ModelReflections($this->eloquentModels);

        $this->booted = true;

    }

    /**
     * @return ModelReflections
     */
    public function reflections()
    {
        return $this->modelReflections;
    }

    /**
     * @return EloquentModels
     */
    public function eloquentModels()
    {
        return $this->eloquentModels;
    }

    /**
     * @return EloquentModels
     */
    public function mezzoModels()
    {
        return $this->mezzoModels;
    }


    /**
     *  Finds all classes that extend the eloquent model
     *
     * @return EloquentModels
     */
    protected function findEloquentModels()
    {
        return new EloquentModels($this->getChildrenOfClass($this->eloquentClass));
    }

    /**
     *  Finds all classes that use the mezzo model trait.
     *
     * @return EloquentModels
     */
    protected function findMezzoModels()
    {
        $classes = $this->getTraitUsingClasses($this->mezzoModelTrait, $this->eloquentModels);

        return new EloquentModels($classes);
    }


    /**
     * Returns a collection of class names that extend a given class.
     *
     * @param string $parentClass
     * @param null | \Traversable $childClasses
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
     * @param $traitName
     * @param null $childClasses
     * @return array
     */
    protected function getTraitUsingClasses($traitName, $childClasses = null)
    {
        if ($childClasses == null) $childClasses = $this->classesInAppFolder();

        $usages = [];

        foreach ($childClasses as $class) {
            if ($this->classUsesTrait($traitName, $class)) $usages[] = $class;
        }

        return $usages;

    }

    /**
     * Helper function that checks if a class uses a trait
     *
     * @param $trait
     * @param $class
     * @return bool
     */
    private function classUsesTrait($trait, $class)
    {
        $usedTraits = class_uses($class);

        return in_array($trait, $usedTraits);
    }

    private function classesInAppFolder()
    {
        $finder = app()->make(ClassFinder::class);
        return $finder->findClasses(app_path());
    }

    /**
     * Get the reflection of the given model or create one
     *
     * @param $model
     * @return mixed
     */
    public function modelReflection($model)
    {
        return $this->reflections()->getOrCreate($model);
    }


    /**
     * Static version of modelReflection($model). Just for your comfort :*
     *
     * @param $model
     * @return mixed
     */
    public static function getReflection($model)
    {
        return static::make()->modelReflection($model);
    }


    /**
     * @return bool
     */
    public function isBooted()
    {
        return $this->booted;
    }


} 