<?php


namespace MezzoLabs\Mezzo\Modules\Addresses;


use App\Address;
use App\User;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

class AddressesModule extends ModuleProvider
{
    protected $models = [
        Address::class,
    ];

    protected $options = [
        'visible' => false
    ];


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Called when module is ready, model reflections are loaded.
     *
     * @return mixed
     */
    public function ready()
    {
        $addressReflection = $this->modelReflectionSets->get(Address::class);

        //dd($addressReflection->relationships());
    }
}