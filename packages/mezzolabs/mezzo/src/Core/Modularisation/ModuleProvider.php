<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\Collections\ModelWrappers;

abstract class ModuleProvider extends ServiceProvider
{
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
    }

    /**
     * Called when module is ready, model wrappers are loaded.
     *
     * @return mixed
     */
    abstract public function ready();

}