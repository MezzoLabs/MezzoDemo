<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Columns\Column;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Core\Schema\Converters\AttributeConverter;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class Attributes extends Collection
{

    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     * @throws InvalidArgumentException
     */
    public function addAttribute(Attribute $attribute)
    {
        return $this->put($attribute->name(), $attribute);
    }

    /**
     * @return Collection
     */
    public function atomicAttributes()
    {
        return $this->filter(function (Attribute $attribute) {
            return $attribute instanceof AtomicAttribute;
        });
    }

    /**
     * @return Collection
     */
    public function relationAttributes()
    {
        return $this->filter(function (Attribute $attribute) {
            return $attribute instanceof RelationAttribute;
        });
    }

    /**
     * Returns an Attribute Collection via the converted columns
     *
     * @param Collection|Columns $columns
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public static function fromColumns(Collection $columns)
    {
        $converter = AttributeConverter::make();
        $attributes = new Attributes();

        $columns->each(function (Column $column) use ($converter, $attributes) {
            $attributes->addAttribute($converter->run($column));
        });

        return $attributes;
    }
} 