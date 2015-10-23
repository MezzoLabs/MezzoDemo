<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Html;

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
            static::$current = LaravelRequest::capture();

        return static::$current;
    }
}