<?php

namespace MezzoLabs\Mezzo\Core\Modularisation\Reflection;

use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Database\Table;

class EloquentModelReflection extends ModelReflection
{
    /**
     * @var Collection
     */
    protected $relationshipReflections;

    /**
     * @var \MezzoLabs\Mezzo\Core\Database\Table
     */
    protected $databaseTable;


    /**
     * @return RelationshipReflections
     */
    public function relationshipReflections()
    {
        if (!$this->relationshipReflections) {
            $this->relationshipReflections = $this->parser()->relationships();
        }

        return $this->relationshipReflections;
    }

    /**
     * Get the ReflectionClass object of the underlying model
     *
     * @return ModelParser
     */
    public function parser()
    {
        if (!$this->parser)
            $this->parser = new ModelParser($this);

        return $this->parser;
    }

    /**
     * @return \MezzoLabs\Mezzo\Core\Database\Table
     */
    public function databaseTable()
    {
        if (!$this->databaseTable)
            $this->databaseTable = Table::fromModelReflection($this);

        return $this->databaseTable;
    }
}