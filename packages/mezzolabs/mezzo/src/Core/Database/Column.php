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

    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @param DoctrineColumn $column
     * @return Column
     */
    public static function fromDoctrine(DoctrineColumn $column)
    {
        $newColumn = new Column($column->getName(), $column->getType());
        $newColumn->setDoctrineColumn($column);

        return $newColumn;
    }

    /**
     * @return DbalColumn
     */
    public function getDoctrineColumn()
    {
        return $this->doctrineColumn;
    }

    /**
     * @param DbalColumn $dbalColumn
     */
    public function setDoctrineColumn($dbalColumn)
    {
        $this->doctrineColumn = $dbalColumn;
    }
} 