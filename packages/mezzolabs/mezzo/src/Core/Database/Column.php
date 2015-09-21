<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Doctrine\DBAL\Schema\Column as DoctrineColumn;
use Doctrine\DBAL\Types\Type;

class Column {

    /**
     * @var Type
     */
    protected $type;

    /**
     * @var string
     */
    protected  $name;

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
    protected  $table;

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
    public function qualifiedName(){
        return $this->table->name() . '.' . $this->name();
    }

    /**
     * Remove the table name from a column.
     *
     * @param $columnName
     * @return mixed
     */
    public static function disqualifyName($columnName){
        if(strstr($columnName, '.'))
            return explode('.', $columnName)[1];

        return $columnName;
    }

    /**
     * @return bool
     */
    public function isForeignKey(){
        if($this->isForeignKey === null)
            $this->isForeignKey = in_array($this->qualifiedName(), $this->table->connectingColumns()->toArray());

        return $this->isForeignKey;
    }

    /**
     * Create a column from the imported dbal column.
     *
     * @param DoctrineColumn $column
     * @param Table $table
     * @return Column
     */
    public static function fromDoctrine(DoctrineColumn $column, Table $table)
    {
        $type = strtolower(str_replace('Type', '', class_basename($column->getType())));

        $newColumn = new Column($column->getName(), $type, $table);
        $newColumn->setDoctrineColumn($column);

        return $newColumn;
    }
}