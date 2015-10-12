<?php

namespace MezzoLabs\Mezzo\Core\Schema\Converters\Eloquent;


use MezzoLabs\Mezzo\Core\Annotations\AnnotationReader;
use MezzoLabs\Mezzo\Core\Database\DatabaseColumn;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\EloquentModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\MezzoModelReflection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\Columns\JoinColumn;
use MezzoLabs\Mezzo\Core\Schema\Converters\ModelConverter;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Exceptions\UnexpectedException;

class ModelReflectionConverter extends ModelConverter
{


    /**
     * @var DatabaseColumnConverter
     */
    protected $attributeConverter;

    /**
     * Create a new ModelReflection Converter instance
     *
     * @param DatabaseColumnConverter $attributeConverter
     */
    public function __construct(DatabaseColumnConverter $attributeConverter)
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
     * @throws UnexpectedException
     */
    protected function fromModelReflectionToSchema(ModelReflection $reflection)
    {
        if($reflection instanceof MezzoModelReflection)
            return $this->fromMezzoReflectionToSchema($reflection);

        if($reflection instanceof EloquentModelReflection)
            return $this->fromEloquentReflectionToSchema($reflection);

        throw new UnexpectedException();
    }

    protected function fromMezzoReflectionToSchema(MezzoModelReflection $reflection)
    {
        $schema = new ModelSchema($reflection->className(), $reflection->tableName());

        $reflection->annotations();

        dd('here to die');


    }

    protected function fromEloquentReflectionToSchema(EloquentModelReflection $reflection)
    {
        $schema = new ModelSchema($reflection->className(), $reflection->databaseTable()->name());

        $reflection->databaseTable()->allColumns()->each(
            function (DatabaseColumn $column) use ($schema) {
                $attribute = $this->attributeConverter->viaDatabaseColumn($column);
                $schema->addAttribute($attribute);
            });

        mezzo()->reflector()->relationSchemas()->joinColumns()->each(
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