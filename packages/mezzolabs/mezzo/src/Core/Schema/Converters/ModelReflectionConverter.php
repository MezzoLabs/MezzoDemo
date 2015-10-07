<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Columns\JoinColumn;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class ModelReflectionConverter extends ModelConverter
{


    /**
     * @var AttributeConverter
     */
    protected $attributeConverter;

    /**
     * Create a new ModelReflection Converter instance
     *
     * @param AttributeConverter $attributeConverter
     */
    public function __construct(AttributeConverter $attributeConverter)
    {
        $this->attributeConverter = $attributeConverter;
    }

    /**
     * Perform a conversion from ModelReflection to ModelSchema
     *
     * @param $modelReflection
     * @return ModelSchema
     */
    public function run($modelReflection)
    {
        return $this->fromModelReflectionToSchema($modelReflection);
    }

    /**
     * @param ModelReflection $reflection
     * @return ModelSchema
     */
    protected function fromModelReflectionToSchema(ModelReflection $reflection)
    {
        $schema = new ModelSchema($reflection->className(), $reflection->table()->name());

        $reflection->table()->allColumns()->each(
            function (DatabaseColumn $column) use ($schema) {
                $attribute = $this->attributeConverter->viaDatabaseColumn($column);
                $schema->addAttribute($attribute);
            });

        mezzo()->reflector()->relationsSchema()->joinColumns()->each(
            function (JoinColumn $column) use ($schema) {

                if (!$column->relation()->connectsTable($schema->tableName()))
                    return;

                $attribute = $this->attributeConverter->viaJoinColumn($column);

                if (!$schema->hasAttribute($column->name())) {
                    $attribute->setPersisted($column->isPersisted());
                    $schema->addAttribute($attribute);
                }

            });

        return $schema;

    }
}