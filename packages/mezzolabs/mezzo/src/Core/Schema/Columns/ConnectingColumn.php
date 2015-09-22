<?php

namespace MezzoLabs\Mezzo\Core\Schema\Columns;


use MezzoLabs\Mezzo\Core\Schema\Relations\Relation;

class ConnectingColumn extends Column{
    /**
     * @var Relation
     */
    private $relation;

    /**
     * @param $name string The qualified name of the column
     * @param $type string
     * @param $table string
     * @param Relation $relation
     */
    public function __construct($name, $type, $table, Relation $relation){

        $this->name = $name;
        $this->relation = $relation;
        $this->type = $type;
        $this->table = $table;
    }


    /**
     * @return Relation
     */
    public function relation()
    {
        return $this->relation;
    }



} 