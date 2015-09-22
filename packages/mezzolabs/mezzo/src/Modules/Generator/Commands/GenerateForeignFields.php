<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Commands;

use Illuminate\Console\Command;
use MezzoLabs\Mezzo\Console\Commands\MezzoCommand;

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

        $this->mezzo->reflector()->relationsSchema()->connectingColumns();
    }
}
