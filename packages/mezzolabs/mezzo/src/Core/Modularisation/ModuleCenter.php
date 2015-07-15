<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Contracts\GeneralModule;
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
     * @var Reflector
     */
    private $reflector;

    /**
     * @param Mezzo $mezzo
     */
    public function __construct(Mezzo $mezzo, Reflector $reflector)
    {
        $this->mezzo = $mezzo;
        $this->modules = new Collection();

        $this->registerGeneralModule($mezzo->make('mezzo.modules.general'));

        $this->reflector = $reflector;
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

    /**
     * Register the module that catches all the models without any module assiciation
     *
     * @param GeneralModule $module
     */
    public function registerGeneralModule(GeneralModule $module){
        $this->modules->put('General', $module);
    }

    /**
     * Get the general module
     *
     * @return GeneralModule
     */
    public function generalModule(){
        return $this->getModule('General');
    }

    /**
     * Get a module from the registration
     *
     * @param string $key
     * @return Module
     */
    public function getModule($key){
        return $this->modules->get($key);
    }

}