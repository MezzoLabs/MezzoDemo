<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

class Attributes extends Collection{

    /**
     * @var Collection
     */
    protected $atomicAttributes;

    /**
     * @var Collection
     */
    protected $relationAttributes;

    public function __construct($items = []){
        parent::__construct($items);

        $this->atomicAttributes = new Collection();
        $this->relationAttributes = new Collection();
    }

    /**
     * @param AtomicAttribute $attribute
     */
    public function addAtomic(AtomicAttribute $attribute){
        $this->put($attribute->name(), $attribute);
    }

    /**
     * @param AtomicAttribute|RelationAttribute $attribute
     */
    public function addRelation(RelationAttribute $attribute){
        $this->put($attribute->name(), $attribute);
    }

    public function addAttribute(Attribute $attribute){
        if(get_class($attribute) == AtomicAttribute::class)
            $this->addAtomic($attribute);

        if(get_class($attribute) == RelationAttribute::class)
            $this->addRelation($attribute);
    }

    /**
     * @return Collection
     */
    public function atomics()
    {
        return $this->atomicAttributes;
    }

    /**
     * @return Collection
     */
    public function relations()
    {
        return $this->relationAttributes;
    }
} 