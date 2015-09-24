<?php

namespace MezzoLabs\Mezzo\Modules\Generator\Schema\Actions;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;

class Actions extends Collection{
    /**
     * @param Action $action
     * @return $this
     */
    public function register(Action $action){
        return $this->put($action->qualifiedName(), $action);
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Modules\Generator\Schema\Actions\Actions
     */
    public function registerCreate(Attribute $attribute){
        return $this->register( new RemoveAction($attribute));
    }

    /**
     * @param Attribute $attribute
     * @return \MezzoLabs\Mezzo\Modules\Generator\Schema\Actions\Actions
     */
    public function registerRemove(Attribute $attribute)
    {
        return $this->register( new RemoveAction($attribute));
    }

    /**
     * @param $table
     * @param $from
     * @param $to
     */
    public function registerRename($table, $from, $to){

    }


} 