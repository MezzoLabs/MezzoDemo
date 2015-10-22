<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;

use Illuminate\Http\Request as LaravelRequest;

class ModuleRequest extends LaravelRequest
{
    /**
     * @var ModuleRequest
     */
    protected static $current;


    /**
     * @return ModuleRequest
     */
    public static function capture()
    {
        if(!static::$current)
            static::$current = parent::capture();

        return static::$current;
    }
}