<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Dingo\Api\Routing\Router as DingoRouter;

class ApiRouter extends DingoRouter
{

    /**
     * @param array $attributes
     * @param callable $callback
     */
    public function group(array $attributes, $callback)
    {
        parent::group($attributes, function(){});

        call_user_func($callback, $this);
    }
}