<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use MezzoLabs\Mezzo\Core\Files\Files;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Core\Schema\ModelSchemas;
use MezzoLabs\Mezzo\Modules\Generator\Schema\ModelTraitSchema;
use MezzoLabs\Mezzo\Modules\Generator\Schema\ModelTraitSchemas;


class ModelTraitGenerator extends FileGenerator
{

    /**
     * @var ModelSchemas
     */
    private $modelSchemas;

    /**
     * @var ModelTraitSchemas
     */
    private $traitSchemas;

    /**
     * @param ModelSchemas $schemas
     */
    public function __construct(ModelSchemas $schemas)
    {
        $this->modelSchemas = $schemas;
    }

    /**
     * Run the generator and save the files to the disk.
     *
     * @return mixed
     */
    public function run()
    {
        $this->files()->save();
    }

    /**
     * Creates a collection of File objects. They contain the files name and the content of the generated file.
     *
     * @return Files
     */
    public function files()
    {
        $files = new Files();

        $modelTraitSchemas = $this->createModelTraitSchemas();

        $modelTraitSchemas->each(
            function (ModelTraitSchema $schema) use ($files) {
                $newFile = $schema->file($this->folderName());
                $files->addFile($newFile);
            });

        return $files;
    }

    /**
     * The name of the folder in which the files are created.
     *
     * @return string
     */
    public function folderName()
    {
        return mezzo()->path()->toMezzoGenerated() . '/ModelTraits';
    }

    /**
     * Create a collection of ModelTrait`s based on the fiven model schemas
     *
     * @return ModelTraitSchemas
     */
    private function createModelTraitSchemas()
    {
        if ($this->traitSchemas) return $this->traitSchemas;

        $modelTraits = new ModelTraitSchemas();

        /*
         * Go through every model schema and create a model trait schema out of it.
         */
        $this->modelSchemas->each(
            function (ModelSchema $modelSchema) use ($modelTraits) {
                $modelTrait = new ModelTraitSchema($modelSchema);

                $modelTraits->put($modelSchema->className(), $modelTrait);
            }
        );

        $this->traitSchemas = $modelTraits;

        return $modelTraits;
    }

    /**
     * @return ModelTraitSchemas
     */
    public function traitSchemas()
    {
        return $this->createModelTraitSchemas();
    }
}