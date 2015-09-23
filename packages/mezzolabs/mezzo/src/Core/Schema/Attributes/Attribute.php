<?php

namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use ArrayAccess;
use Illuminate\Support\Collection;
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
     * @var Collection
     */
    protected $options;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var bool
     */
    protected $persisted = true;

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
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return bool
     */
    public function hasTable(){
        return !empty($this->table);
    }

    /**
     * @return boolean
     */
    public function isPersisted()
    {
        return $this->persisted;
    }

    /**
     * @param boolean $persisted
     */
    public function setPersisted($persisted)
    {
        $this->persisted = $persisted;
    }


    /**
     * @param array|ArrayAccess $options
     */
    protected function setOptions($options){
        $this->options = new Collection($options);
    }




    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
} 