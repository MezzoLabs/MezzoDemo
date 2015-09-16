<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 14:05
 * Project: MezzoDemo
 */
 
 

namespace MezzoLabs\Mezzo\Core\Modularisation\Attributes;


use MezzoLabs\Mezzo\Core\Modularisation\Attributes\Types\Type;

class Attribute {
    /**
     * @var string
     */
    protected  $name;
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var \ArrayAccess
     */
    protected $options;

    /**
     * @param $name
     * @param Type $type
     * @param \ArrayAccess $options
     */
    public function __construct($name, Type $type, \ArrayAccess $options){
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }
} 