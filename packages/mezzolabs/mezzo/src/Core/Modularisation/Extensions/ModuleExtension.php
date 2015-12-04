<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Extensions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

abstract class ModuleExtension implements ModuleExtensionContract
{
    /**
     * @var ModuleProvider
     */
    protected $module;

    /**
     * @param ModuleProvider $module
     */
    public function __construct(ModuleProvider $module)
    {
        $this->module = $module;
    }

    /**
     * The module that this extension is based on.
     *
     * @return ModuleProvider
     */
    public function module()
    {
        return $this->module;
    }

    public static function make()
    {

    }
}