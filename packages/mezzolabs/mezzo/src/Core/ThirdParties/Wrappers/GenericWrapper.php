<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


use Illuminate\Config\Repository as ConfigRepository;
use MezzoLabs\Mezzo\Core\Configuration\MezzoConfig;
use MezzoLabs\Mezzo\Core\Mezzo;

abstract class GenericWrapper {

    /**
     * The string of the package service provider
     *
     * @var string
     */
    protected $provider = "";

    /**
     * @var array
     */
    protected $providerOptions = [];

    /**
     * @var Mezzo
     */
    protected $mezzo;

    /**
     * @var MezzoConfig
     */
    protected $mezzoConfig;

    /**
     * @param Mezzo $mezzo
     * @param MezzoConfig $mezzoConfig
     * @internal param ConfigRepository $configuration
     */
    public function __construct(Mezzo $mezzo, MezzoConfig $mezzoConfig){
        $this->mezzo = $mezzo;
        $this->mezzoConfig = $mezzoConfig;
    }

    /**
     * Register the wrapped service provider.
     *
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register(){
        if(empty($this->provider))
            throw new \RuntimeException("No provider set for wrapper: ". get_called_class());

        return $this->mezzo->app()->register($this->provider, $this->providerOptions);
    }
}