<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Modules\Generator\Migration\ChangeSet;
use MezzoLabs\Mezzo\Core\Files\Files;
use MezzoLabs\Mezzo\Modules\Generator\Generators\Generator;
use MezzoLabs\Mezzo\Modules\Generator\Schema\MigrationAction;
use MezzoLabs\Mezzo\Modules\Generator\Schema\MigrationSchema;
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
        return $this->files()->save();
    }

    /**
     * Creates a collection of File objects. They contain the files name and the content of the generated file.
     *
     * @return Files
     */
    public function files(){
        $files = new Files();

        $this->createMigrationsSchema()->each(function(MigrationSchema $schema) use ($files){
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
        return mezzo()->path()->toDatabaseDirectory() . '/migrations';
    }
}