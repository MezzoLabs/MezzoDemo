<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Dingo\Api\Http\Parser\Accept as AcceptParser;
use Dingo\Api\Routing\Router as DingoRouter;
use MezzoLabs\Mezzo\Exceptions\RoutingException;

class ApiRouter extends DingoRouter
{

    /**
     * @return ApiConfig
     */
    protected static function makeApiConfig()
    {
        return mezzo()->make(ApiConfig::class);
    }

    /**
     * @param array $attributes
     * @param callable $callback
     */
    public function group(array $attributes, $callback)
    {
        parent::group($attributes, function () {
        });

        call_user_func($callback, $this);
    }

    /**
     * Create a new API Router instance that will eventually become a singleton inside the laravel container.
     *
     * @return ApiRouter
     * @throws RoutingException
     */
    public static function makeNewApiRouter()
    {
        $app = app();

        if (!$app['api.router.adapter'])
            throw new RoutingException('Cannot instantiate the ApiRouter, because Dingo is not booted yet.');

        $apiConfig = static::makeApiConfig();

        $acceptParser = new AcceptParser($apiConfig->get('vendor'), $apiConfig->get('version'), $apiConfig->get('defaultFormat'));

        return new ApiRouter(
            $app['api.router.adapter'],
            $acceptParser,
            $app['api.exception'],
            $app,
            $apiConfig->get('domain'),
            $apiConfig->get('prefix')
        );
    }
}