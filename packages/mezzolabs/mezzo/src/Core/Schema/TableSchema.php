<?php

namespace MezzoLabs\Mezzo\Core\Schema;


use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;

class TableSchema {
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Attributes
     */
    protected $attributes;


    public function __construct($name){
        $this->attributes = new Attributes();
        $this->name = $name;
    }

    /**
     * @return Attributes
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function addAttribute(Attribute $attribute){
        return $this->attributes->addAttribute($attribute);
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
} 