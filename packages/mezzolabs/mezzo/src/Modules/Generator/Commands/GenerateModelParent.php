<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Commands;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Console\Commands\MezzoCommand;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Columns\JoinColumn;
use MezzoLabs\Mezzo\Modules\Generator\Generators\MigrationGenerator;
use MezzoLabs\Mezzo\Modules\Generator\Migration\ChangeSet;

class GenerateModelParent extends MezzoCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mezzo:generate:model-parent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the model parent based on the model code.';

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
        $this->mezzo->makeDatabaseReader();

        $notPersisted = $this->allJoinColumns()->filter(function (JoinColumn $column) {
            return !$column->isPersisted();
        });

        $toAdd = Attributes::fromColumns($notPersisted);

        $changeSet = new ChangeSet();
        $changeSet->createAttributes($toAdd);

        $migrationGenerator = new MigrationGenerator($changeSet);


        $migrationGenerator->run();
    }

    /**
     * @return Collection
     */
    protected function allJoinColumns()
    {
        return $this->mezzo->reflector()->relationSchemas()->joinColumns();

    }
}
