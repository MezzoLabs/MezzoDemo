<?php


namespace MezzoLabs\Mezzo\Core\Database;


use Illuminate\Support\Collection;

class TableSchema {
    /**
     * @var Collection
     */
    protected $columns;

    /**
     * @return Collection
     */
    public function columns(){
        if(!$this->columns) $this->columns = new Collection();

        return $this->columns;
    }

    /**
     * @param Table $table
     */
    public function readFromDatabase(Table $table)
    {
        $array = Reader::make()->getColumns($table);

        $this->columns = new Collection();
        foreach($array as $doctrineColumn){
            $this->columns->put($doctrineColumn->getName(), Column::fromDoctrine($doctrineColumn));
        }


        return $this->columns;
    }




} 