<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters;


use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\GenericModelReflection;
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
     * @param GenericModelReflection $reflection
     * @return ModelSchema
     */
    protected function fromModelReflectionToSchema(GenericModelReflection $reflection)
    {
        $schema = new ModelSchema($reflection->className(), $reflection->databaseTable()->name());

        $reflection->databaseTable()->allColumns()->each(
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