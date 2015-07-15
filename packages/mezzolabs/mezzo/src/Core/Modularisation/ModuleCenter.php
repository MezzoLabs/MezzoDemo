<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Contracts\Module;
use MezzoLabs\Mezzo\Core\Mezzo;

class ModuleCenter
{
    /**
     * @var Collection[Module] of all registered modules
     */
    protected $modules;

    /**
     * @var Mezzo
     */
    private $mezzo;

    /**
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;
        $this->modules = new Collection();

    }

    /**
     * Add a new module to the Mezzo module center.
     *
     * @param Module $module
     */
    public function register(Module $module){
        if($this->isRegistered($module))
            return false;

        $this->modules->put(get_class($module), $module);
    }

    /**
     * Checks if a module class is already registered
     *
     * @param Module $module
     * @return bool
     */
    public function isRegistered(Module $module){
        return $this->modules->has(get_class($module));
    }

}