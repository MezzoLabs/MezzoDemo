<?php

namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumns;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Exceptions\InvalidArgumentException;

class ModelSchema {

    /**
     * @var string
     */
    protected $className;

    /**
     * @var ModelTables
     */
    protected $tables;


    public function __construct($className, $tableName = false){
        $this->className = $className;

        $this->tables = new ModelTables();
        $this->tables->setModel($this);

        $this->addMainTable($tableName);
    }

    public function addMainTable($tableName){
        if(empty($tableName)) $tableName = $this->defaultTableName();

        $this->tables->addMainTable(new TableSchema($tableName));
    }

    /**
     * @return string
     */
    public function tableName(){
        return $this->mainTable()->name();
    }


    public function defaultTableName()
    {
        return str_replace('\\', '', Str::snake(Str::plural(class_basename($this->className))));
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function addAttribute(Attribute $attribute){
        return $this->tables->addAttribute($attribute);
    }

    /**
     * @return Attributes\Attributes
     */
    public function attributes(){
        return $this->mainTable()->attributes();
    }

    /**
     * @return TableSchema
     */
    public function mainTable(){
        return $this->tables->main();
    }

    /**
     * Check if this model contains a certain attribute.
     *
     * @param $attribute
     * @return bool
     * @throws InvalidArgumentException
     * @internal param $name
     */
    public function hasAttribute($attribute)
    {
        if($attribute instanceof Attribute)
            $attribute = $attribute->name();

        if(!is_string($attribute))
            throw new InvalidArgumentException($attribute);

        return $this->attributes()->has($attribute);
    }
} 