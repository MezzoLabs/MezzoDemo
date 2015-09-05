<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;

use App\Tutorial;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Filesystem\ClassFinder;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Collections\EloquentModels;
use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapping\ModelWrappers;
use MezzoLabs\Mezzo\Core\Traits\MezzoModel;

class Reflector
{

    /**
     * @var Mezzo
     */
    private $mezzo;

    /**
     * @var EloquentModels
     */
    private $eloquentModels;

    /**
     * @var string class name of the eloquent mode base class
     */
    private $eloquentClass = EloquentModel::class;

    /**
     * @var string class name of the eloquent mode base class
     */
    private $mezzoModelTrait = MezzoModel::class;

    /**
     * @var ModelWrappers
     */
    protected $modelWrappers;

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
        if($this->booted) return false;

        $this->eloquentModels = $this->findEloquentModels();
        $this->modelWrappers = $this->findMezzoModels();

        $this->booted = true;

    }


    /**
     * @return ModelWrappers
     */
    public function wrappers(){
        return $this->modelWrappers;
    }

    /**
     * @return EloquentModels
     */
    public function eloquentModels(){
        return $this->eloquentModels;
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
     *
     */
    protected function findMezzoModels()
    {
        $classes = $this->getTraitUsingClasses($this->mezzoModelTrait, $this->eloquentModels);

        return new ModelWrappers($classes);
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

    private function classesInAppFolder(){
        $finder = app()->make(ClassFinder::class);
        return $finder->findClasses(app_path());
    }


} 