<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Dingo\Api\Http\Parser\Accept as AcceptParser;
use Dingo\Api\Routing\Router as DingoRouter;
use MezzoLabs\Mezzo\Exceptions\RoutingException;

class ApiRouter
{

    /**
     * @var DingoRouter
     */
    private $dingoRouter;

    public function __construct(DingoRouter $dingoRouter)
    {
        $this->dingoRouter = $dingoRouter;
    }

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
        $this->dingoRouter->group($attributes, function(){});
        call_user_func($callback, $this);
    }

    /**
     * @param string $uri
     * @param array|string|callable $action
     */
    public function get($uri, $action)
    {
        return $this->dingoRouter->get($uri, $action);
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->dingoRouter;
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