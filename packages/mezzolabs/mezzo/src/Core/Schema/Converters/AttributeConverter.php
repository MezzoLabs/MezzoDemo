<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;

class AttributeConverter extends Converter{

    public function fromDatabaseColumn(DatabaseColumn $column){


    }

    protected function createRelationAttribute(){

    }

    public function run($toConvert)
    {
        if($toConvert instanceof DatabaseColumn)
            return $this->fromDatabaseColumn($toConvert);
    }
}