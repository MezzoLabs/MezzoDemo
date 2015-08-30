<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Generic;


use Illuminate\Support\ServiceProvider;

abstract class Module extends ServiceProvider{
    /**
     * A collection of associated models.
     *
     * @var ModelWrappers
     */
    public $models;
} 