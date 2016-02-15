<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Schema\Relations\ManyToMany;

class PivotAttribute extends Attribute
{
    /**
     * @var ManyToMany
     */
    protected $relation;

    /**
     * @param $name
     * @param ManyToMany $relation
     * @param array $options
     */
    public function __construct($name, ManyToMany $relation, $options = [])
    {
        $this->name = $name;

        $this->setOptions($options);
        $this->findType();
        $this->relation = $relation;
    }

    /**
     * @return ManyToMany
     */
    public function relation()
    {
        return $this->relation;
    }
}