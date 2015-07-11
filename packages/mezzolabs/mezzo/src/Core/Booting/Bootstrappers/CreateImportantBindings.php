<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\ThirdParties;

class CreateImportantBindings implements Bootstrapper{

    /**
     * Important singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'mezzo.thirdParties' => ThirdParties::class,
        'mezzo.config' => MezzoConfig::class
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
        $app->instance(get_class($mezzo), $mezzo);

        foreach($this->singletons as $key => $class){
            $this->bindSingleton($app, $key, $class);
        }
    }

    /**
     * Bind a key and the full class name to a single instance.
     *
     * @param Application $app
     * @param $key
     * @param $class
     */
    protected function bindSingleton(Application $app, $key, $class){
        $instance = $app->make($class);

        $app->instance($key, $instance);
        $app->alias($key, $class);
    }

}