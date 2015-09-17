<?php


namespace MezzoLabs\Mezzo\Core\Schema;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attributes;

class TableSchema {
    /**
     * @var Collection
     */
    protected $columns;

    /**
     * @var Attributes
     */
    protected $attributes;

    /**
     * @var string
     */
    private $name;

    /**
     * Initialize a theoretical playground for tables
     *
     * @param $name
     */
    public function __construct($name){

        $this->name = $name;
        $this->attributes = new Collection();
    }

    /**
     * @return Collection
     */
    public function columns(){
        if(!$this->columns) $this->columns = new Collection();

        return $this->columns;
    }

    /**
     * @param Table $table
     * @return \Illuminate\Support\Collection
     */
    public function fillWithRealTable(Table $table)
    {
        $array = Reader::make()->getColumns($table);

        $this->columns = new Collection();
        foreach($array as $doctrineColumn){
            $this->columns->put($doctrineColumn->getName(), Column::fromDoctrine($doctrineColumn));
        }

        return $this->columns;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param Attribute $attribute
     * @return $this
     */
    public function addAttribute(Attribute $attribute){
        return $this->attributes->put($attribute->name(), $attribute);
    }


}