<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Columns\Column;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Core\Schema\Converters\AttributeConverter;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class Attributes extends Collection{

    public function __construct($items = []){
        parent::__construct($items);
    }

    /**
     * @param AtomicAttribute $attribute
     * @return $this
     */
    public function addAtomic(AtomicAttribute $attribute){
        return $this->put($attribute->name(), $attribute);
    }

    /**
     * @param AtomicAttribute|RelationAttribute $attribute
     * @return $this
     */
    public function addRelation(RelationAttribute $attribute){
        return $this->put($attribute->name(), $attribute);
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     * @throws InvalidArgumentException
     */
    public function addAttribute(Attribute $attribute){
        if($attribute instanceof AtomicAttribute)
            return $this->addAtomic($attribute);

        if($attribute instanceof RelationAttribute)
            return $this->addRelation($attribute);

        throw new InvalidArgumentException($attribute);
    }

    /**
     * @return Collection
     */
    public function atomics()
    {
        return $this->filter(function(Attribute $attribute){
            return $attribute instanceof AtomicAttribute;
        });
    }

    /**
     * @return Collection
     */
    public function relations()
    {
        return $this->filter(function(Attribute $attribute){
            return $attribute instanceof RelationAttribute;
        });
    }

    /**
     * Returns an Attribute Collection via the converted columns
     *
     * @param Columns $columns
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public static function fromColumns(Collection $columns)
    {
        $converter = AttributeConverter::make();
        $attributes = new Attributes();

        $columns->each(function(Column $column) use ($converter, $attributes){
            $attributes->addAttribute($converter->run($column));
        });

        return $attributes;
    }
} 