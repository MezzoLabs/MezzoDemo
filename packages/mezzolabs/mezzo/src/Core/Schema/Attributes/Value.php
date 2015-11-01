<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


class Value
{
    /**
     * @var Attribute
     */
    protected $attribute;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Creates a new value storage.
     *
     * @param $value
     * @param Attribute $attribute
     */
    public function __construct($value, Attribute $attribute)
    {

        $this->attribute = $attribute;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return Attribute
     */
    public function attribute()
    {
        return $this->attribute;
    }
}