<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Extensions;


trait HasModuleExtensions
{
    /**
     * @var ModuleExtensionCollection
     */
    protected $extensions = null;

    /**
     * @return ModuleExtensionCollection
     */
    public function extensions()
    {
        if (!$this->extensions)
            $this->extensions = new ModuleExtensionCollection();

        return $this->extensions;
    }

    /**
     * Register a new extension
     *
     * @param ModuleExtensionContract|string|array $moduleExtension
     */
    public function registerExtension($moduleExtension)
    {
        // Check if the given variable is an array. Register them one by one.
        if (is_array($moduleExtension)) {
            foreach ($moduleExtension as $current)
                $this->registerExtension($current);
            return;
        }

        // If this module extension is only a class name we will create an instance first.
        if (is_string($moduleExtension))
            $moduleExtension = app()->make($moduleExtension, ['module' => $this]);

        $this->extensions()->put(get_class($moduleExtension), $moduleExtension);
    }

    /**
     * Calls the boot method on all extensions
     */
    public function bootExtensions()
    {
        $this->extensions()->boot();
    }
}