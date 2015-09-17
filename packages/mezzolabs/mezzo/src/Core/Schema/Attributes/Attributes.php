<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


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
     * @param AtomicAttribute $attribute
     */
    public function addRelation(AtomicAttribute $attribute){
        $this->put($attribute->name(), $attribute);
    }

    /**
     * @return Collection
     */
    public function atomic()
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