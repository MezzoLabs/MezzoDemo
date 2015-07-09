<?php


namespace MezzoLabs\Mezzo\Core;


use Illuminate\Foundation\Application;

class Mezzo {

    protected $app;

    public function __construct(Application $app){
        $this->app = $app;
    }

} 