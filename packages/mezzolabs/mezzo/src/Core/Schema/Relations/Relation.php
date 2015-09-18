<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


abstract class Relation {
    /**
     * @var string
     */
    protected $fromTable;

    /**
     * @var string
     */
    protected $toTable;

    /**
     * @var string
     */
    protected $connectingTable;

    /**
     * @var string
     */
    protected $connectingColumn;

    /**
     * @param $fromTable
     * @param $toTable
     */
    public function __construct($fromTable, $toTable){
        $this->toTable = $toTable;
        $this->fromTable = $fromTable;
    }
} 