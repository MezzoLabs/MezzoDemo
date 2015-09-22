<?php

 
namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;

class AtomicAttribute extends Attribute {
    /**
     * @param $name
     * @param \MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType $inputType
     * @param \ArrayAccess $options
     */
    public function __construct($name, InputType $inputType, \ArrayAccess $options){
        $this->name = $name;
        $this->type = $inputType;
        $this->options = $options;
    }
} 