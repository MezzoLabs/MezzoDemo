<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class ModelReflectionConverter extends ModelConverter{


    /**
     * @var AttributeConverter
     */
    protected $attributeConverter;

    public function __construct(AttributeConverter $attributeConverter)
    {
        $this->attributeConverter = $attributeConverter;
    }

    public function run($modelReflection)
    {
        return $this->fromModelReflectionToSchema($modelReflection);
    }

    protected function fromModelReflectionToSchema(ModelReflection $reflection){
        $schema = new ModelSchema($reflection->className(), $reflection->table()->name());

        $reflection->table()->allColumns()->each(function(DatabaseColumn $column){
            $attribute = $this->attributeConverter->fromDatabaseColumn($column);
        });

        return $schema;

    }
}