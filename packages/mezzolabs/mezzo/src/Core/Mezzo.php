<?php


namespace MezzoLabs\Mezzo\Core;


use Illuminate\Foundation\Application;
use MezzoLabs\Mezzo\Core\Booting\BootManager;

class Mezzo extends Application{

    /**
     * Indicates if mezzo has "booted".
     *
     * @var bool
     */
    protected $booted = false;


    /**
     * The Laravel Application
     *
     * @var Application
     */
    protected $app;

    public function __construct(Application $app){
        $this->app = $app;
    }

    /**
     * Get the Laravel application
     *
     * @return Application
     */
    public function app(){
        return $this->app;
    }

    /**
     * Bootstrap Mezzo
     */
    public function bootstrap(){
        if($this->booted) return false;

        $bootManager = BootManager::make();
        $bootManager->run($this);

        $this->booted = true;
    }




} 