<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Mezzo;

class RegisterConfiguredModuleProviders implements Bootstrapper
{

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        $providerClasses = $mezzo->config()->get('moduleProviders');

        foreach ($providerClasses as $providerClass) {
            $serviceProvider = $mezzo->moduleCenter()->register($providerClass);
        }
    }
}