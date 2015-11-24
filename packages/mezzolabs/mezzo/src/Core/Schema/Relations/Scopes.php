<?php


namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use MezzoLabs\Mezzo\Core\Collection\StrictCollection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class Scopes extends StrictCollection
{

    /**
     * Check if a item can be part of this collection.
     *
     * @param $value
     * @return boolean
     */
    protected function checkItem($value)
    {
        return $value instanceof Scope;
    }

    public static function buildFromString($scopesString)
    {
        $scopes = new static();

        $scopeStrings = explode('|', $scopesString);

        foreach ($scopeStrings as $scopeString) {
            $scope = Scope::buildFromString($scopeString);
            $scopes->add($scope);
        }

        return $scopes;
    }

    /**
     * Synonym for push.
     *
     * @param  mixed $value
     * @return $this
     * @throws InvalidArgumentException
     */
    public function add($value)
    {
        if (!$value instanceof Scope)
            throw new InvalidArgumentException($value);

        $this->put($value->name(), $value);
    }
}