<?php


namespace MezzoLabs\Mezzo\Core\Schema\Attributes;



use Illuminate\Support\Facades\Input;
use MezzoLabs\Mezzo\Core\Collection\DecoratedCollection;
use MezzoLabs\Mezzo\Core\Collection\StrictCollection;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class Values extends StrictCollection
{
    public function add(Value $value)
    {
        $this->put($value->attribute()->name(), $value);
    }


    protected function checkItem($value)
    {
        return $value instanceof Value::class;
    }

    protected function fromModel(){
        $values = new Values();
    }

    public static function fromInput(ModelSchema $model, $data = []){
        $values = new Values();

        if(empty($data))
            $data = Input::all();

        foreach($data as $key => $value){
            //TODO: Go through every dat
                    }

    }
}