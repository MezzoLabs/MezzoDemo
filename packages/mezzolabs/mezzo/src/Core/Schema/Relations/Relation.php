<?php

namespace MezzoLabs\Mezzo\Core\Schema\Relations;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationshipReflection;
use MezzoLabs\Mezzo\Exceptions\InvalidArgument;

abstract class Relation
{
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
    protected $fromNaming;

    /**
     * @var string
     */
    protected $toNaming;


    public function __construct()
    {

    }

    public function from($fromTable, $relationNaming = "")
    {
        $this->setTable('from', $fromTable, $relationNaming);
        return $this;
    }

    public function to($toTable, $relationNaming = "")
    {
        $this->setTable('to', $toTable, $relationNaming);
        return $this;
    }

    public function isInitialized(){
        return $this->fromTable && $this->fromNaming && $this->toTable && $this->toNaming;
    }

    /**
     * Internal function to set a table attribute and the according name for one part of this relationship.
     *
     * @param $type
     * @param $tableName
     * @param string $relationNaming
     */
    protected function setTable($type, $tableName, $relationNaming = "")
    {
        if ($relationNaming) $relationNaming = $tableName;

        $tableAttribute = $type . 'Table';
        $namingAttribute = $type . 'Naming';

        $this->$tableAttribute = $tableName;
        $this->$namingAttribute = $relationNaming;
    }

    abstract public function qualifiedName();


    /**
     * Create a new relation. Do not forget to call from and to afterwards.
     *
     * @param $type
     * @return Relation
     */
    public static function makeByType($type)
    {
        $class = static::typeToClassName($type);
        return new $class();
    }


    /**
     * Convert the type of a relationship to the according class name.
     *
     * @param $type
     * @return mixed
     */
    protected static function typeToClassName($type)
    {
        if (class_exists($type)) return $type;

        switch (strtolower($type)) {
            case 'onetoone':
                return OneToOne::class;
            case 'onetomany':
                return OneToMany::class;
            case 'manytomany':
                return ManyToMany::class;
            default:
                throw new InvalidArgument($type);
        }
    }

    /**
     * @return string
     */
    public function toNaming()
    {
        if(!$this->toNaming) return $this->toTable;

        return $this->toNaming;
    }

    /**
     * @return string
     */
    public function toTable()
    {
        return $this->toTable;
    }

    /**
     * @return string
     */
    public function fromNaming()
    {
        if(!$this->fromNaming) return $this->fromTable;

        return $this->fromNaming;
    }

    /**
     * @return string
     */
    public function fromTable()
    {
        return $this->fromTable;
    }

} 