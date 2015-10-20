<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\ModulePageException;

class ModuleControllers extends Collection
{
    public function add(ModuleControllerContract $controller)
    {
        $this->put(get_class($controller), $controller);
    }
}