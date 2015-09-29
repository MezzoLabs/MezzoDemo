<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Console\Commands\MezzoCommand;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Core\Schema\Columns\ConnectingColumn;
use MezzoLabs\Mezzo\Modules\Generator\Migration\ChangeSet;
use MezzoLabs\Mezzo\Modules\Generator\Generators\MigrationGenerator;

class GenerateForeignFields extends MezzoCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mezzo:generate:foreignFields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the foreign fields migrations based on the model code.';

    /**
     * Create a new command instance.
     *
     * @return \MezzoLabs\Mezzo\Modules\Generator\Commands\GenerateForeignFields
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reader = $this->mezzo->makeDatabaseReader();

        $notPersisted = $this->allConnectingColumns()->filter(function(ConnectingColumn $column){
            return !$column->isPersisted();
        });

        $toAdd = Attributes::fromColumns($notPersisted);

        $changeSet = new ChangeSet();
        $changeSet->createAttributes($toAdd);

        $migrationGenerator = new MigrationGenerator($changeSet);
        //$migrationsSchema = $migrationGenerator->createMigrationsSchema();
        dd($migrationGenerator->run());
    }

    /**
     * @return Collection
     */
    protected function allConnectingColumns(){
        return $this->mezzo->reflector()->relationsSchema()->connectingColumns();

    }
}
