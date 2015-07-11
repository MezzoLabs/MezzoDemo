<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use Illuminate\Container\Container;
use MezzoLabs\Mezzo\Core\Mezzo;

class CreateImportantBindings implements Bootstrapper{

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function boot(Mezzo $mezzo)
    {
        $app = $mezzo->app();

        $app->singleton('mezzo', function(Container $app){
            return $app->make(Mezzo::class);
        });
    }
}