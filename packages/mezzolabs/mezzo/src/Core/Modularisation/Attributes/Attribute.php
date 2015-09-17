<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 14:05
 * Project: MezzoDemo
 */
 
 

namespace MezzoLabs\Mezzo\Core\Modularisation\Attributes;


use MezzoLabs\Mezzo\Core\Modularisation\Attributes\InputTypes\Type;

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
     * @param \MezzoLabs\Mezzo\Core\Modularisation\Attributes\InputTypes\Type $inputType
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

    public function generateHtml(){
        $tag = $this->type->htmlTag();
        $attributes = $this->htmlAttributes();

        $html = '<' . $tag;

        foreach($attributes as $key => $value){
            if(is_numeric($value))
                $html .= ' ' . $key . '=' . $value;
            else
                $html .= ' ' . $key . '=' . $value;
        }

        if($this->type->htmlIsVoid()) return $html . ' />';

        return $html . '>'.  $this->content() .'</' . $tag .'>';

    }

    public function content(){
        return 'nope';
    }
} 