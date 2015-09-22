<?php

namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\Type;

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
     * @param \MezzoLabs\Mezzo\Core\Schema\InputTypes\Type $inputType
     * @param \ArrayAccess $options
     */
    public function __construct($name, Type $inputType, \ArrayAccess $options){
        $this->name = $name;
        $this->type = $inputType;
        $this->options = $options;
    }

    /**
     * Get the html attributes as array.
     *
     * @return array
     */
    public function htmlAttributes(){
        $attributes = [
            'type' => $this->type->htmlType(),
            'name' => $this->name,
        ];

        return array_filter($attributes);
    }


    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
} 