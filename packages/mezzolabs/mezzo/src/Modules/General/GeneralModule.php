<?php


namespace MezzoLabs\Mezzo\Modules\General;


use MezzoLabs\Mezzo\Core\Modularisation\Generic\AbstractGeneralModule;

class GeneralModule extends AbstractGeneralModule
{
    protected $models = [];

    protected $group = "admin";

    protected $options = [
        'icon' => 'ion-speedometer'
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
        $this->loadViews();
    }
}