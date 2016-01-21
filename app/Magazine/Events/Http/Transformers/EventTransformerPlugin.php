<?php

namespace App\Magazine\Events\Http\Transformers;


use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Http\Transformers\Plugins\TransformerPlugin;

class EventTransformerPlugin extends TransformerPlugin
{

    /**
     * @param MezzoModel $model
     * @return array
     */
    public function transform(MezzoModel $model) : array
    {
        if(! $model instanceof \App\Event){
            return [];
        }

        return [
            '_start' => $model->start()->toDateTimeString(),
            '_end' => $model->end()->toDateTimeString()
        ];
    }
}