<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class ModelReflectionConverter extends ModelConverter{

    public function run($modelReflection)
    {
        return $this->fromModelReflectionToSchema($modelReflection);
    }

    protected function fromModelReflectionToSchema(ModelReflection $reflection){
        $schema = new ModelSchema($reflection->className(), $reflection->table()->name());

        foreach($reflection->table()->allColumns() as $column){

        }

    }
}