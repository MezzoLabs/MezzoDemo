<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Modules\General\Module;
use MezzoLabs\Mezzo\Providers\EventServiceProvider;

class FinishModules implements Bootstrapper{

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        $mezzo->moduleCenter()->modules()->map(function(ModuleProvider $moduleProvider){
            $moduleProvider->ready();
        });
    }
}