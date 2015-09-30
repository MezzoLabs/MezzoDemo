<?php


namespace MezzoLabs\Mezzo\Modules\Generator\Migration;


use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

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

        if($this->attribute->)

        return $this->lines($columnType);
    }

    private function foreignKey(){

    }

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

    protected function columnType(){
        return $this->attribute->getType()->doctrineType()->getName();
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