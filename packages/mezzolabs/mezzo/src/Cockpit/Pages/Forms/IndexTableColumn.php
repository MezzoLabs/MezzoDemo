<?php


namespace MezzoLabs\Mezzo\Cockpit\Pages\Forms;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;

class IndexTableColumn
{
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $type;

    /**
     * @var Collection
     */
    public $options;

    /**
     * IndexTableColumn constructor.
     * @param string $name
     * @param string $type
     * @param array $options
     */
    public function __construct(string $name, string $type, $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->options = new Collection($options);
    }

    public function setRelation(RelationSide $relation)
    {
        $this->options->put('relation', [
            'hasMultipleChildren' => $relation->hasMultipleChildren(),
            'column' => $relation->attributeName()
        ]);
    }

    public static function makeFromAttribute(Attribute $attribute)
    {
        $column = new static($attribute->name(), $attribute->type()->doctrineTypeName());

        if ($attribute instanceof RelationAttribute) {
            $column->setRelation($attribute->relationSide());
        }

        return $column;
    }
}