<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Configuration\Configuration;
use MezzoLabs\Mezzo\Core\Mezzo;

class LoadConfiguration implements Bootstrapper{


    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        $this->configurationInstance($mezzo)->prepare();
    }

    /**
     * @param Mezzo $mezzo
     * @return Configuration
     */
    private function configurationInstance(Mezzo $mezzo){
        return $mezzo->make('mezzo.configuration');
    }
}