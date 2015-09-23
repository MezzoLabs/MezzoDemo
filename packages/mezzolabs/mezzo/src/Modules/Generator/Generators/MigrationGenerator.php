<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Generators;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Core\Schema\Columns\Columns;
use MezzoLabs\Mezzo\Modules\Generator\Generators\Generator;
use MezzoLabs\Mezzo\Modules\Generator\Schema\MigrationAction;

class MigrationGenerator extends Generator
{
    /**
     * @param Attributes $toAdd
     * @param Attributes $toRemove
     */
    public function __construct(Attributes $toAdd = null, Attributes $toRemove = null)
    {
        $this->toAdd =      ($toAdd)    ? $toAdd    : new Attributes();
        $this->toRemove =   ($toRemove) ? $toRemove : new Attributes();
    }

    /**
     * @param MigrationAction $action
     */
    public function register(MigrationAction $action){

    }

    public function registerAdd($attribute){

    }

    public function registerRemove($attribute)
    {

    }

    public function registerRename($table, $from, $to){

    }

    public function createMigrations(){

    }


} 