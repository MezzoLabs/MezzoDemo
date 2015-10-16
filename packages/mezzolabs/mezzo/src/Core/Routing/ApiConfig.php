<?php


namespace MezzoLabs\Mezzo\Core\Routing;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Exceptions\RoutingException;

class ApiConfig
{
    /**
     * @var array
     */
    protected $defaults = [
        "version" => "1",
        "prefix" => "mezzo",
        "vendor" => "MezzoLabs",
        'debug' => false,
        'strict' => true
    ];

    /**
     * @var Collection
     */
    protected $entries;

    /**
     * Creates the container for the API configuration.
     */
    public function __construct()
    {
        $this->entries = new Collection();

        $this->readApiConfiguration();
    }

    /**
     * Read the dingo api configuration from the mezzo config file.
     */
    protected function readApiConfiguration()
    {
        foreach ($this->defaults as $key => $default) {
            $this->entries->put($key, mezzo()->config('api.' . $key, $default));
        }
    }


    /**
     * Get an entry from the API config.
     *
     * @param string $key
     * @return $this|mixed
     * @throws RoutingException
     */
    public function get($key = "")
    {
        if (empty($key)) return $this;

        if (!$this->has($key))
            throw new RoutingException($key . ' is not a valid part of the API config . ');

        return $this->entries->get($key);
    }

    /**
     * Check if this API config is set.
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return $this->entries->has($key);
    }

    public static function make(){
        return mezzo()->make(ApiConfig::class);
    }
}