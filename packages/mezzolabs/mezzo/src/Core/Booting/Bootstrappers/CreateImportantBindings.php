<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use Illuminate\Container\Container;
use MezzoLabs\Mezzo\Core\Configuration\Configuration;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\Manager as ThirdPartyManager;

class CreateImportantBindings implements Bootstrapper{

    /**
     * Important singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'mezzo.configuration' => Configuration::class,
        'mezzo.thirdParties' => ThirdPartyManager::class
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

        // Bind the singletons
        foreach($this->singletons as $key => $class){
            $app->singleton($key, function(Container $app) use ($class){
                return $app->make($class);
            });

            $app->instance($class, $app->make($class));
        }
    }

}