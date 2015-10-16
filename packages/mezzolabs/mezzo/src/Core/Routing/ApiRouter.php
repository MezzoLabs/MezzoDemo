<?php


namespace MezzoLabs\Mezzo\Core\Routing;

use Closure;
use Dingo\Api\Routing\Router as DingoRouter;
use MezzoLabs\Mezzo\Core\ThirdParties\Wrappers\DingoApi;

class ApiRouter
{
    /**
     * @var ApiConfig
     */
    protected $config;

    /**
     * @var DingoRouter
     */
    private $dingoRouter;

    public function __construct()
    {
        $this->dingoRouter = DingoApi::make()->getDingoRouter();
        $this->config = $this->makeApiConfig();
    }

    /**
     * @return ApiConfig
     */
    protected static function makeApiConfig()
    {
        return mezzo()->make(ApiConfig::class);
    }

    /**
     * @param string $uri
     * @param array|string|callable $action
     * @return mixed
     */
    public function get($uri, $action)
    {
        return $this->dingoRouter->get($uri, $action);
    }

    /**
     * @return DingoRouter
     */
    public function getDingoRouter()
    {
        return $this->dingoRouter;
    }

    public function api(Closure $callback, $overwriteAttributes = [])
    {
        $attributes = $this->config->merge($overwriteAttributes)->toArray();

        $this->group($attributes, $callback);
    }

    /**
     * @param array $attributes
     * @param callable $callback
     */
    public function group(array $attributes, $callback)
    {

        $this->dingoRouter->group($attributes, function (DingoRouter $api) use ($callback) {

            call_user_func($callback, $this);
        });

    }
}