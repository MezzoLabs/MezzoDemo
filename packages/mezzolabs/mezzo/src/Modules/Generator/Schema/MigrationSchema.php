<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Modules\Generator\Schema\Actions\Actions;

class MigrationSchema {
    /**
     * @var string
     */
    protected $table;

    /**
     * @var Actions
     */
    protected $actions;

    /**
     * @param $table
     * @param Actions $actions
     * @internal param Attributes $toAdd
     * @internal param Attributes $toRemove
     */
    public function __construct($table, Actions $actions)
    {

        $this->table = $table;
        $this->actions = $actions;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return Actions
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param Actions $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

} 