<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;
use MezzoLabs\Mezzo\Modules\Generator\Schema\Actions\Actions;

class MigrationSchema extends Schema{
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
     * @return \Illuminate\Contracts\View\View
     */
    public function content()
    {
        return $this->makeTemplate(['migration' => $this]);
    }

    protected function templateName()
    {
        return 'migration';
    }

    /**
     * Return the class name of the migration
     *
     * @return string
     */
    public function name()
    {
        return implode('', $this->nameParts());
    }

    public function shortFileName()
    {
        $parts = $this->nameParts();

        foreach($parts as &$part) $part = strtolower($part);

        $date = date('Y_M_D_His');

        return $date . '_' . implode('_', $parts) . '.php';
    }

    protected function nameParts(){
        $parts = [];

        if(!$this->tableIsPersisted()){
            $parts[] = 'Create';
        }
        else {
            $parts[] = 'Update';
        }

        $parts[] = ucfirst($this->table);
        $parts[] = 'Table';

        return $parts;
    }

    /**
     * @return string
     */
    public function table()
    {
        return $this->table;
    }

    /**
     * @return bool
     */
    public function tableIsPersisted(){
        return mezzo()->makeDatabaseReader()->tableIsPersisted($this->table());
    }


    /**
     * @return Actions
     */
    public function actions()
    {
        return $this->actions;
    }


}