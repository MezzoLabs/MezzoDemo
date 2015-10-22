<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Html;


use Illuminate\Filesystem\ClassFinder;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;

class ModulePages extends Collection
{
    public function add(ModulePageContract $modulePage)
    {
        if ($this->has($modulePage->name())) {
            throw new ModulePageException('The page ' . $modulePage->name() . ' is already registered for this module.');
        }

        $this->put($modulePage->name(), $modulePage);
    }

    public function collectFromFolder($folder, $module)
    {
        if (!is_dir($folder))
            return false;

        $pageClasses = (new ClassFinder())->findClasses($folder);

        foreach ($pageClasses as $pageClass) {
            if (!is_subclass_of($pageClass, ModulePage::class))
                throw new ModulePageException($pageClass . ' is not a valid module page.');

            $this->add(new $pageClass($module));
        }
    }


    public function collectFromModule(ModuleProvider $module)
    {
        $pagesFolder = $module->path() . '/Http/Pages/';

        $this->collectFromFolder($pagesFolder, $module);
    }

    public function registerRoutes()
    {
        $this->each(function (ModulePage $page) {
            $page->registerRoutes();
        });
    }
}