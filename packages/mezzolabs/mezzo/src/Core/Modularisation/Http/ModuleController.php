<?php


namespace MezzoLabs\Mezzo\Core\Modularisation\Http;


use Dingo\Api\Routing\Helpers as ApiHelpers;

abstract class ModuleController implements ModuleControllerContract
{
    use ApiHelpers;
}