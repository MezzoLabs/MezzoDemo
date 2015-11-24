<?php


namespace MezzoLabs\Mezzo\Core\Schema\Relations;


class Scope
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param $name
     * @param array $parameters
     */
    public function __construct($name, $parameters = [])
    {
        $this->name = $name;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function parameters()
    {
        return $this->parameters;
    }

    public static function buildFromString($scopeString)
    {
        $parts = explode(':', $scopeString);

        $name = $parts[0];

        $parameters = (count($parts) == 2) ? explode(',', $parts[1]) : [];

        return new static($name, $parameters);
    }
}