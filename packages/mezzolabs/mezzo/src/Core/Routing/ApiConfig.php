<?php


namespace MezzoLabs\Mezzo\Core\Routing;


use Illuminate\Support\Collection;

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


    public function get($key = "")
    {
        if (empty($key)) return $this;

        if (!isset($this->apiConfig[$key])
        throw new RoutingException($key . ' is not a valid part of the API config . ');

        return $this->apiConfig[$key];
    }

    public function has($key)
    {
        return $this->entries->has($key);
    }
}