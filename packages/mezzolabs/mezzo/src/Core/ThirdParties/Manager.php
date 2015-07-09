<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties;


use MezzoLabs\Mezzo\Core\ThirdParties\Providers;

class Manager {

    /**
     * @var Providers\ThirdPartyContract[]
     */
    protected $providers = [
        DingoApi::class
    ];

    public function register(){
        foreach($this->providers as $provider){
            $provider->register();
        }
    }

} 