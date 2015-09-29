<?php

namespace MezzoLabs\Mezzo\Modules\Generator;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Schema\Attributes\Attribute;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;
use MezzoLabs\Mezzo\Modules\Generator\Schema\Actions\Action;
use MezzoLabs\Mezzo\Modules\Generator\Schema\Actions\Actions;

class ChangeSet {

    /**
     * @var Actions
     */
    protected $actions;

    public function __construct(Actions $actions = null){
        if(!$actions) $actions = new Actions();

        $this->actions = $actions;
    }


    public function checkModelAgainstDatabase(ModelSchema $modelSchema){

    }


    public function createAttributes(Collection $attributes){
        /** @var Action $action */
        foreach($attributes as $attribute){
            $this->actions->registerCreate($attribute);
        }
    }

    /**
     * @return Actions
     */
    public function actions()
    {
        return $this->actions;
    }
} 