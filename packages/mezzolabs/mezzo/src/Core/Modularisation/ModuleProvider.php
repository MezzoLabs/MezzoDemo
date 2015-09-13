<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflections;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;

abstract class ModuleProvider extends ServiceProvider
{
    public $isGeneral = false;

    /**
     * @var String[]
     */
    protected $models = [];

    /**
     * @var ModelReflections
     */
    protected $modelReflections;

    /**
     * @var Mezzo
     */
    private $mezzo;

    /**
     * Create a new module provider instance
     *
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;

        parent::__construct($this->mezzo->app());

        $this->modelReflections = new ModelReflections();
    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    abstract public function ready();

    /**
     * @return \String[]
     */
    public function models()
    {
        return $this->models;
    }

    public function identifier()
    {
        return get_class($this);
    }

    /**
     * @param ModelReflection $model
     */
    public function associateModel(ModelReflection $model)
    {
        $this->modelReflections->add($model);
    }

    public function modelReflections(){
        return $this->modelReflections;
    }




}