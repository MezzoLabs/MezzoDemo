<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Doctrine\DBAL\Schema\Column as DoctrineColumn;
use Doctrine\DBAL\Types\Type;
use MezzoLabs\Mezzo\Core\Modularisation\Reflection\RelationshipReflection;
use MezzoLabs\Mezzo\Core\Schema\Columns\ConnectingColumn;

class DatabaseColumn
{

    /**
     * @var Type
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var DoctrineColumn
     */
    protected $doctrineColumn;

    /**
     * @var bool
     */
    protected $isForeignKey;

    /**
     * @var Table
     */
    protected $table;

    /**
     * @var ConnectingColumn
     */
    protected $connectingColumn = false;


    public function __construct($name, $type, Table $table)
    {
        $this->name = $name;
        $this->type = $type;
        $this->table = $table;
    }

    /**
     * @return DoctrineColumn
     */
    public function getDoctrineColumn()
    {
        return $this->doctrineColumn;
    }

    /**
     * @param DoctrineColumn $dbalColumn
     */
    public function setDoctrineColumn($dbalColumn)
    {
        $this->doctrineColumn = $dbalColumn;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return Type
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Returns the unique name of this column.
     *
     * @return string
     */
    public function qualifiedName()
    {
        return $this->table->name() . '.' . $this->name();
    }

    /**
     * Remove the table name from a column.
     *
     * @param $columnName
     * @return mixed
     */
    public static function disqualifyName($columnName)
    {
        if (strstr($columnName, '.'))
            return explode('.', $columnName)[1];

        return $columnName;
    }

    /**
     * @return bool
     */
    public function isForeignKey()
    {
        return $this->connectingColumn() !== null;
    }

    /**
     * Get the according connecting column from the relations schema.
     * Returns null if this column is a simple column.
     *
     * @return ConnectingColumn|mixed
     */
    public function connectingColumn(){
        if($this->connectingColumn === false) {
            $relationsSchema = mezzo()->reflector()->relationsSchema();
            $this->connectingColumn = $relationsSchema->connectingColumns($this->table->name())
                                        ->get($this->qualifiedName());
        }

        return $this->connectingColumn;

    }


    /**
     * Create a column from the imported dbal column.
     *
     * @param DoctrineColumn $column
     * @param Table $table
     * @return DatabaseColumn
     */
    public static function fromDoctrine(DoctrineColumn $column, Table $table)
    {
        $type = strtolower(str_replace('Type', '', class_basename($column->getType())));

        $newColumn = new DatabaseColumn($column->getName(), $type, $table);
        $newColumn->setDoctrineColumn($column);

        return $newColumn;
    }

    /**
     * @return Table
     */
    public function table()
    {
        return $this->table;
    }
}