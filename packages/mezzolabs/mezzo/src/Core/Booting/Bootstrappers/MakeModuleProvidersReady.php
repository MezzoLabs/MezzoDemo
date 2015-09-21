<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\Reflector;
use MezzoLabs\Mezzo\Modules\General\GeneralModule;
use MezzoLabs\Mezzo\Providers\EventServiceProvider;

class MakeModuleProvidersReady implements Bootstrapper{

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        $mezzo->moduleCenter()->associateModels();

        $mezzo->moduleCenter()->modules()->map(function(ModuleProvider $moduleProvider){
            $moduleProvider->ready();
        });
    }
}