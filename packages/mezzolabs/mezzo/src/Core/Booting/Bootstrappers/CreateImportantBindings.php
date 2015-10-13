<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Console\MezzoKernel;
use MezzoLabs\Mezzo\Core\Annotations\Reader\AnnotationReader;
use MezzoLabs\Mezzo\Core\Cache\Singleton;
use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Core\Database\Reader;
use MezzoLabs\Mezzo\Core\Helpers\Path;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleCenter;
use MezzoLabs\Mezzo\Core\Reflection\ModelFinder;
use MezzoLabs\Mezzo\Core\Reflection\ModelMapper;
use MezzoLabs\Mezzo\Core\Reflection\ReflectionManager;
use MezzoLabs\Mezzo\Core\Reflection\Reflectors\MezzoModelsReflector;
use MezzoLabs\Mezzo\Core\Routing\Router;
use MezzoLabs\Mezzo\Core\ThirdParties\ThirdParties;
use MezzoLabs\Mezzo\Modules\General\GeneralModule;

class CreateImportantBindings implements Bootstrapper
{

    /**
     * Important singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'mezzo.thirdParties' => ThirdParties::class,
        'mezzo.config' => MezzoConfig::class,
        'mezzo.router' => Router::class,
        'mezzo.path' => Path::class,
        'mezzo.modelfinder' => ModelFinder::class,
        'mezzo.modelMappings' => ModelMapper::class,
        'mezzo.annotationReader' => AnnotationReader::class,
        'mezzo.reflectionManager' => ReflectionManager::class,
        'mezzo.modules.general' => GeneralModule::class,
        'mezzo.moduleCenter' => ModuleCenter::class,
        'mezzo.database.reader' => Reader::class,
        'mezzo.cache.singleton' => Singleton::class,
        'mezzo.kernel' => MezzoKernel::class
    ];

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        $app = $mezzo->app();

        $app->instance('mezzo', $mezzo);
        $app->alias('mezzo', get_class($mezzo));

        $this->bindSingletons($mezzo);
    }

    /**
     * Bind the configured instances
     *
     * @param Mezzo $mezzo
     */
    protected function bindSingletons(Mezzo $mezzo)
    {
        foreach ($this->singletons as $key => $class) {
            $this->bindSingleton($mezzo->app(), $key, $class);
        }
    }

    /**
     * Bind a key and the full class name to a single instance.
     *
     * @param Application $app
     * @param $key
     * @param $class
     */
    protected function bindSingleton(Application $app, $key, $class)
    {

        $instance = $app->make($class);

        $app->instance($key, $instance);
        $app->alias($key, $class);

    }

}