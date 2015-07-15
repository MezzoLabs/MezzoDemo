<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;
use MezzoLabs\Mezzo\Core\Mezzo;

abstract class ModuleProvider extends ServiceProvider
{
    /**
     * @var String[]
     */
    protected $modules = [];

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


}