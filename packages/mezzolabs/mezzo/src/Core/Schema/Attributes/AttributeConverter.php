<?php

namespace MezzoLabs\Mezzo\Core\Schema\Attributes;


use MezzoLabs\Mezzo\Core\Modularisation\Reflection\ModelReflection;
use MezzoLabs\Mezzo\Core\Database\Column;

class AttributeConverter {
    /**
     * @param ModelReflection $reflection
     * @throws \Exception
     */
    public function fromReflection(ModelReflection $reflection){
        if($reflection->isMezzoModel()) return $this->fromMezzoModel($reflection);

        $attributes = new Attributes();

        foreach($reflection->table()->allColumns() as $column){

        }
    }

    public function fromDatabaseColumn(){

    }

    public function fromMezzoModel(){
        throw new \Exception('not yet done');
        //TODO
    }


} 