<?php


namespace MezzoLabs\Mezzo\Core\Configuration;


use MezzoLabs\Mezzo\Core\Mezzo;

class Configuration {
    /**
     * @var Mezzo
     */
    private $mezzo;

    function __construct(Mezzo $mezzo)
    {
        $this->mezzo = $mezzo;
    }


    /**
     * Load the Mezzo specific configuration. Also warm up the third party configuration.
     */
    public function load(){
        $this->mergeConfig();

        $this->thirdPartyConfiguration();
    }

    /**
     * Merge the config from mezzo with the one of the application
     */
    protected function mergeConfig(){
        $this->mezzo->serviceProvider->mergeConfigFrom( __DIR__.'../../../../config/config.php', 'mezzo');
    }

    protected function thirdPartyConfiguration(){

    }
} 