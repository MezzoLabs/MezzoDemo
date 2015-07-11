<?php


namespace MezzoLabs\Mezzo\Core\Booting\Bootstrappers;


use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\Manager;

class IncludeThirdParties implements Bootstrapper{

    /**
     * Run the booting process for this service.
     *
     * @param Mezzo $mezzo
     * @return mixed
     */
    public function bootstrap(Mezzo $mezzo)
    {
        $manager = $this->getManagerInstance($mezzo);
        $manager->registerWrappers();
    }

    /**
     * @param Mezzo $mezzo
     * @return Manager
     */
    private function getManagerInstance(Mezzo $mezzo){
        return $mezzo->make(Manager::class);
    }
}