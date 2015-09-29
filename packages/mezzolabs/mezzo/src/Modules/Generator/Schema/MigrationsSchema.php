<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Modules\Generator\Migration\ChangeSet;
use MezzoLabs\Mezzo\Modules\Generator\Migration\Actions\Actions;

class MigrationsSchema extends Collection{

    public function addChangeSet(ChangeSet $changeSet){
        $this->addActions($changeSet->actions());
    }

    public function addActions(Actions $actions){
        $groupedActions = $actions->groupByTables();

        $groupedActions->each(function(Actions $tableActions, $tableName){
            $this->addMigrationSchema(new MigrationSchema($tableName, $tableActions));
        });
    }

    /**
     * @param MigrationSchema $migrationSchema
     */
    public function addMigrationSchema(MigrationSchema $migrationSchema)
    {
        $this->put($migrationSchema->table(), $migrationSchema);
    }
} 