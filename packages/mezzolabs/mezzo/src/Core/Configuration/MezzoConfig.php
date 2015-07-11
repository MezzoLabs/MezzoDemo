<?php


namespace MezzoLabs\Mezzo\Core\Configuration;


use Illuminate\Config\Repository;
use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\ThirdParties\ThirdParties;

class MezzoConfig {
    /**
     * @var Mezzo
     */
    private $mezzo;
    /**
     * @var ThirdParties
     */
    private $thirdParties;
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param Mezzo $mezzo
     * @param ThirdParties $thirdParties
     * @param Repository $repository
     */
    function __construct(Mezzo $mezzo, ThirdParties $thirdParties, Repository $repository)
    {
        $this->mezzo = $mezzo;
        $this->thirdParties = $thirdParties;
        $this->repository = $repository;
    }


    /**
     * Load the Mezzo specific configuration. Also warm up the third party configuration.
     */
    public function load(){
        $this->mergeConfig();
    }

    /**
     * Merge the config from mezzo with the one of the application
     */
    protected function mergeConfig(){
        $this->mezzo->serviceProvider->mergeConfigFrom( __DIR__.'../../../../config/config.php', 'mezzo');
    }

    /**
     * Called after all the providers registered and before one provider boots.
     */
    public function beforeProvidersBoot(){
        $this->thirdParties->prepareConfigs();
    }

    /**
     * Get the Laravel config repository.
     *
     * @return Repository
     */
    public function repository(){
        return $this->repository;
    }

    /**
     * Overwrite one config key with another. Needed for overwriting config files at runtime.
     *
     * @param $weakKey
     * @param $strongKey
     */
    public function overwrite($weakKey, $strongKey){

    }



} 