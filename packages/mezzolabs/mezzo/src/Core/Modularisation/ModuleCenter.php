<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapping\ModelWrappers;
use MezzoLabs\Mezzo\Core\Modularisation\Generic\GeneralModule;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\ModelWrapping\ModelWrapper;
use MezzoLabs\Mezzo\Exceptions\MezzoException;
use MezzoLabs\Mezzo\Exceptions\ModelCannotBeAssociated;
use MezzoLabs\Mezzo\Exceptions\ModelCannotBeFound;
use MezzoLabs\Mezzo\MezzoServiceProvider;
use Mockery\CountValidator\Exception;

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
     * @var ModelWrappers
     */
    private $grabbedModels;

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
     * Check if the given instance is the general module.
     *
     * @param $instance
     * @return bool
     */
    public function isGeneralModule($instance){
        $className = get_class($instance);
        $generalClassName = get_class($this->generalModule());

        return $className == $generalClassName;
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

    /**
     * Check the models that each module requires and associate the models with them.
     * Make sure there are no conflicts.
     */
    public function associateModels(){
        $this->modules()->map(function(ModuleProvider $module, $key){

            if($this->isGeneralModule($module)) return;

            foreach($module->models() as $model){
                $this->associateModel($model, $module);
            }
        });

        $this->fillGeneralModule();

    }

    /**
     * Grab the unassociated models and give them to the general module.
     */
    private function fillGeneralModule(){
        $allModels = $this->reflector()->wrappers();



        $allModels->map(function(ModelWrapper $model, $key){
            if($model->hasModule()) return;

            $this->associateWithGeneralModule($model);
        });
    }

    /**
     * @param ModelWrapper $model
     */
    public function associateWithGeneralModule(ModelWrapper $model){
        $this->associateModel($model, $this->generalModule());
    }

    /**
     * Connect a model to this module. It will be blocked for other modules to grab this model afterwards.
     *
     * @param $model
     * @param ModuleProvider $module
     * @internal param $className
     */
    public function associateModel($model, ModuleProvider $module){
        $modelWrapper = $this->findModelWrapper($model);
        $modelWrapper->setModule($module);
    }


    /**
     * @param $model
     * @throws MezzoException
     * @throws ModelCannotBeFound
     * @return ModelWrapper
     */
    public function findModelWrapper($model){
        if(is_string($model)){
            $allModels = $this->reflector()->wrappers();

            if(!$allModels->has($model)){
                throw new ModelCannotBeFound($model);
            }
            return $allModels->get($model);
        }

        if(ModelWrapper::class == get_class($model)){
            return $model;
        }

        throw new MezzoException($model . ' is not a valid model.');

    }
}