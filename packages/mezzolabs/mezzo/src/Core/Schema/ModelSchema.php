<?php

namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

class ModelSchema {

    /**
     * @var string
     */
    protected $className;

    /**
     * @var TableSchemes
     */
    protected $tables;

    /**
     * @var Collection
     */
    protected $attributes;

    public function __construct($className, $tableName = false){
        $this->className = $className;
        $this->table = new TableSchemes();
        $this->addMainTable($tableName);
    }

    public function addMainTable($tableName){
        if(empty($tableName)) $tableName = $this->defaultTableName();

        $this->tables->addMainTable(new TableSchema($tableName));
    }

    public static function fromReflection(ModelReflection $reflection)
    {
        $schema = new ModelSchema($reflection->className());
        
        foreach($reflection->table()->columns() as $column){

        }
    }

    public function defaultTableName()
    {
        return str_replace('\\', '', Str::snake(Str::plural(class_basename($className))));
    }


    public function addAttribute(Attribute $attribute){

    }

    /**
     * @return TableSchema
     */
    public function mainTable(){
        return $this->tables->main();
    }
} 