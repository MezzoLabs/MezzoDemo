<?php

namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumns;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

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


    public function defaultTableName()
    {
        return str_replace('\\', '', Str::snake(Str::plural(class_basename($this->className))));
    }

    /**
     * @param Attribute $attribute
     */
    public function addAttribute(Attribute $attribute){
        return $this->attributes()->addAttribute($attribute);
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
} 