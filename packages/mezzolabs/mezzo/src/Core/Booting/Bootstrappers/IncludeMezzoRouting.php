<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Mezzo;

class IncludeMezzoRouting implements Bootstrapper{

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        if (! $mezzo->app()->routesAreCached()) {

            require mezzo_source_path() . 'Http/routes.php';
        }
    }
}