<?php


namespace MezzoLabs\Mezzo\Core\ThirdParties\Wrappers;


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

    public function __construct(Mezzo $mezzo){
        $this->mezzo = $mezzo;
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