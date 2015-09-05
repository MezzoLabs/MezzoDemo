<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Collections\ModelWrappers;

abstract class ModuleProvider extends ServiceProvider
{
    public $isGeneral = false;

    /**
     * @var String[]
     */
    protected $models = [];

    /**
     * @var ModelWrappers
     */
    protected $modelWrappers;

    /**
     * @var
     */
    private $mezzo;

    /**
     * Create a new module provider instance
     *
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo){

        $this->mezzo = $mezzo;

        $this->modelWrappers = new ModelWrappers();
    }

    /**
     * Called when module is ready, model wrappers are loaded.
     *
     * @return mixed
     */
    abstract public function ready();

    /**
     * @return \String[]
     */
    public function models(){
        return $this->models;
    }

    public function identifier(){
        return get_class($this);
    }

    /**
     * @param ModelWrapper $model
     */
    public function associateModel(ModelWrapper $model)
    {
        $this->modelWrappers->add($model);
    }


}