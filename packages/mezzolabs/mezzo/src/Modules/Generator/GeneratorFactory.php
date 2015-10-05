<?php


namespace MezzoLabs\Mezzo\Modules\Generator;


use MezzoLabs\Mezzo\Core\Mezzo;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Core\Schema\ModelSchemas;
use MezzoLabs\Mezzo\Modules\Generator\Generators\MigrationGenerator;
use MezzoLabs\Mezzo\Modules\Generator\Generators\ModelTraitGenerator;
use MezzoLabs\Mezzo\Modules\Generator\Migration\ChangeSet;

class GeneratorFactory
{
    /**
     * @var Mezzo
     */
    private $mezzo;
    /**
     * @var GeneratorModule
     */
    private $generatorModule;

    public function __construct(Mezzo $mezzo, GeneratorModule $generatorModule)
    {
        $this->mezzo = $mezzo;
        $this->generatorModule = $generatorModule;
    }

    /**
     * @param ChangeSet $changeSet
     * @return MigrationGenerator
     */
    public function migrationGenerator(ChangeSet $changeSet)
    {
        return new MigrationGenerator($changeSet);
    }

    /**
     * @param ModelSchemas $modelsSchema
     * @return ModelTraitGenerator
     */
    public function modelTraitGenerator(ModelSchemas $modelsSchema){
        return new ModelTraitGenerator($modelsSchema);
    }

}