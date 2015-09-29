<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Modules\Generator\ChangeSet;
use MezzoLabs\Mezzo\Modules\Generator\File\Files;
use MezzoLabs\Mezzo\Modules\Generator\Generators\Generator;
use MezzoLabs\Mezzo\Modules\Generator\Schema\MigrationAction;
use MezzoLabs\Mezzo\Modules\Generator\Schema\MigrationsSchema;

class MigrationGenerator extends Generator
{

    /**
     * @var ChangeSet
     */
    protected $changeSet;


    public function __construct(ChangeSet $changeSet)
    {
        $this->changeSet = $changeSet;
    }

    /**
     * @return MigrationsSchema
     */
    public function createMigrationsSchema(){
        $migrationsSchema = new MigrationsSchema();
        $migrationsSchema->addChangeSet($this->changeSet);

        return $migrationsSchema;
    }


    /**
     * Run the generator and save the files to the disk.
     *
     * @return mixed
     */
    public function run()
    {

    }

    /**
     * Creates a collection of File objects. They contain the files name and the content of the generated file.
     *
     * @return Files
     */
    protected function files(){
        $files = new Files();

        return $files;
    }


}