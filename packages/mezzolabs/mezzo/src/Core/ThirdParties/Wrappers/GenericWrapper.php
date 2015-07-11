<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


use Illuminate\Config\Repository as ConfigRepository;
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
    private $mezzo;
    /**
     * @var
     */
    private $configuration;

    /**
     * @param Mezzo $mezzo
     * @param ConfigRepository $configuration
     */
    public function __construct(Mezzo $mezzo, ConfigRepository $configuration){
        $this->mezzo = $mezzo;
        $this->configuration = $configuration;
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