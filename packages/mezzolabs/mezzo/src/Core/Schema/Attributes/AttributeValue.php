<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


class AttributeValue
{
    /**
     * @var Attribute|RelationAttribute
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
     * @return Attribute|RelationAttribute
     */
    public function attribute()
    {
        return $this->attribute;
    }

    public function name()
    {
        return $this->attribute()->name();
    }

    public function isInteger()
    {
        return is_integer($this->value());
    }

    public function isEmptyRelation()
    {
        return $this->attribute->isRelationAttribute() && empty($this->value());
    }

    public function isOneChildRelationInMainTable()
    {
        if(!$this->isOneChildRelation())
            return false;

        return $this->attribute()->relationSide()->containsTheJoinColumn();
    }

    public function isOneChildRelation()
    {
        if(!$this->attribute->isRelationAttribute())
            return false;

        return $this->attribute->hasOneChild();
    }
}