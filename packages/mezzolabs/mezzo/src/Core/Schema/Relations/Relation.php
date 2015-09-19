<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationshipReflection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgument;

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

    abstract public function qualifiedName();


} 