<?php

namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Schema\InputTypes\InputType;

class Attribute {
    /**
     * @var string
     */
    protected  $name;
    /**
     * @var InputType
     */
    protected $type;

    /**
     * @var \ArrayAccess
     */
    protected $options;


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