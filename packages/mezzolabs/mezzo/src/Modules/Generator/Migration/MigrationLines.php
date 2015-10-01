<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Migration;


use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\RelationAttribute;

class MigrationLines {
    /**
     * @var Attribute
     */
    private $attribute;

    public function __construct(Attribute $attribute){

        $this->attribute = $attribute;
    }

    /**
     * Gets a Collection of MigrationLine's for an Attribute
     *
     * @return Collection
     */
    public function get()
    {
        $columnType = $this->columnType();

        if($this->attribute->name() === "id")
            return $this->lines(MigrationLine::increments());

        if($this->attribute->isForeignKey())
            return $this->foreignKey($this->attribute);

        return $this->lines($columnType);
    }


    /**
     * @param RelationAttribute $attribute
     * @return Collection
     */
    private function foreignKey(RelationAttribute $attribute){
        $otherSide = $attribute->relationSide()->otherSide();

        $type = $attribute->getType();
        $name = $attribute->name();
        $referencesColumn = $otherSide->primaryKey();
        $referencesTable = $otherSide->table();

        $columnLine = MigrationLine::column($type, $name);
        $foreignKey = MigrationLine::start()->addForeignKey($name, $referencesTable, $referencesColumn);

        return $this->lines([$columnLine, $foreignKey]);
    }

    /**
     * @param $line
     * @return Collection
     */
    private function lines($line){
        if($line instanceof Collection)
            return $line;

        if(is_array($line)){
            return new Collection($line);
        }

        $lines = new Collection();
        $lines->push($line);
        return $lines;
    }

    /**
     * @return string
     */
    protected function columnType(){
        return $this->attribute->getType()->doctrineTypeInstance()->getName();
    }


    /**
     *  Gets a Collection of MigrationLine's for an Attribute
     *
     * @param Attribute $attribute
     * @return mixed
     */
    public static function forAttribute(Attribute $attribute)
    {
        return (new static($attribute))->get();
    }
} 