<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Schema;


use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;

class MigrationSchema {
    /**
     * @var Attributes
     */
    protected $toAdd;

    /**
     * @var Attributes
     */
    private $toRemove;

    /**
     * @var string
     */
    private $table;


    /**
     * @param $table
     * @param Attributes $toAdd
     * @param Attributes $toRemove
     */
    public function __construct($table, Attributes $toAdd = null, Attributes $toRemove = null)
    {
        $this->toAdd =      ($toAdd)    ? $toAdd    : new Attributes();
        $this->toRemove =   ($toRemove) ? $toRemove : new Attributes();
        $this->table = $table;
    }

} 