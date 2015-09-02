<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\Generic\GeneralModule;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\MezzoServiceProvider;

class ModuleCenter
{
    /**
     * A collection of the registered Module providers
     *
     * @var Collection
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
     * @param Reflector $reflector
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
     * @param String $moduleProviderClass
     */
    public function register($moduleProviderClass){
        if($this->isRegistered($moduleProviderClass))
            return false;

        $moduleProvider = $this->mezzo->make($moduleProviderClass);
        $this->mezzo->app()->register($moduleProvider);

        $this->put($moduleProvider);
    }

    /**
     * Put function that only accepts module providers.
     *
     * @param ModuleProvider $moduleProvider
     */
    protected function put(ModuleProvider $moduleProvider){
        $this->modules->put(get_class($moduleProvider), $moduleProvider);
    }

    /**
     * Checks if a module class is already registered
     *
     * @param string $moduleProviderClass
     * @return bool
     */
    public function isRegistered($moduleProviderClass){
        return $this->modules->has($moduleProviderClass);
    }

    /**
     * Register the module that catches all the models without any module association
     *
     * @param GeneralModule $module
     */
    public function registerGeneralModule(GeneralModule $module){
        $this->modules->put('general', $module);
    }

    /**
     * Get the general module
     *
     * @return GeneralModule
     */
    public function generalModule(){
        return $this->getModule('general');
    }

    /**
     * Get a module from the registration
     *
     * @param string $key
     * @return ModuleProvider
     */
    public function getModule($key){
        return $this->modules->get($key);
    }

    /**
     * @return Collection
     */
    public function modules(){
        return $this->modules;
    }

    /**
     * @return Reflector
     */
    public function reflector(){
        return $this->reflector;
    }

    public function associateModels(){

        $modelWrappers = $this->reflector()->wrappers();

        $this->modules()->map(function(ModuleProvider $module, $key){



        });
    }





}