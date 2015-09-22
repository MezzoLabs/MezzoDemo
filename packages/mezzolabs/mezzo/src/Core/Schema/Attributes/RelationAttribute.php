<?php

 
namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;
use MezzoLabs\Mezzo\Core\Schema\Relations\RelationSide;

class RelationAttribute extends Attribute {
    /**
     * @var RelationSide
     */
    private $relationSide;

    /**
     * @param $name
     * @param RelationSide $relationSide
     * @param \ArrayAccess $options
     * @internal param InputType $inputType
     */
    public function __construct($name, RelationSide $relationSide, \ArrayAccess $options){
        $this->name = $name;
        $this->options = $options;
        $this->relationSide = $relationSide;
    }
} 