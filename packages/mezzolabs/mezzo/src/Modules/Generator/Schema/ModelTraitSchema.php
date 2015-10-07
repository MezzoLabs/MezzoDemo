<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class ModelTraitSchema extends FileSchema
{
    /**
     * @var ModelSchema
     */
    private $modelSchema;

    /**
     * Create a new model trait schema based on a model schema
     *
     * @param ModelSchema $modelSchema
     */
    public function __construct(ModelSchema $modelSchema)
    {
        $this->modelSchema = $modelSchema;
    }

    /**
     * The content of the generated file.
     *
     * @return string
     */
    public function content()
    {
        return $this->fillTemplate(['trait' => $this]);
    }

    /**
     * @return ModelSchema
     */
    public function modelSchema()
    {
        return $this->modelSchema;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes
     */
    public function attributes()
    {
        return $this->modelSchema->attributes();
    }

    /**
     * Returns the relations of the model.
     *
     * @return \MezzoLabs\Mezzo\Core\Schema\RelationSchemas
     */
    public function relations()
    {
        return $this->modelSchema()->relations();
    }

    /**
     * Returns the relation sides of the model.
     *
     * @return \Illuminate\Support\Collection
     */
    public function relationSides()
    {
        return $this->modelSchema()->relationSides();
    }

    /**
     * The name of the template inside view folder.
     *
     * @return string
     */
    protected function templateName()
    {
        return 'modeltrait';
    }

    /**
     * The file name of the according file.
     *
     * @return string
     */
    protected function shortFileName()
    {
        return $this->name() . '.php';
    }

    public function name(){
        return 'Mezzo' . $this->modelSchema()->shortName();
    }

    public function table()
    {
        return $this->modelSchema()->tableName();
    }
}