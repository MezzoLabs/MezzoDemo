<?php


namespace MezzoLabs\Mezzo\Core\Modularisation;


use Illuminate\Support\ServiceProvider;

abstract class GenericModule extends ServiceProvider{
    /**
     * A collection of associated models.
     *
     * @var ModelWrappers
     */
    public $models;
} 