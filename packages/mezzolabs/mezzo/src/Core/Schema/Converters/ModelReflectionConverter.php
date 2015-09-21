<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;

class ModelReflectionConverter extends ModelConverter{

    public function run($modelReflection)
    {
        return $this->fromModelReflectionToSchema($modelReflection);
    }

    protected function fromModelReflectionToSchema(ModelReflection $reflection){
        //TODO
    }
}