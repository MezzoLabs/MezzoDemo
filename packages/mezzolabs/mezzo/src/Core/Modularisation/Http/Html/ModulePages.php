<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http\Html;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;

class ModulePages extends Collection
{
    public function add(ModulePageContract $modulePage)
    {
        if (!$this->has($modulePage->name())) {
            throw new ModulePageException('The page ' . $modulePage->name() . ' is already registered for this module.');
        }

        $this->put($modulePage->name(), $modulePage);
    }
}