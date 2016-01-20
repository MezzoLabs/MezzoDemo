<?php

namespace App\Magazine\Subscriptions\Http;


use App\Subscription;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Models\MezzoModel;
use MezzoLabs\Mezzo\Http\Transformers\Plugins\TransformerPlugin;

class SubscriptionTransformerPlugin extends TransformerPlugin
{

    /**
     * @param MezzoModel $model
     * @return array
     */
    public function transform(MezzoModel $model) : array
    {
        if(! $model instanceof Subscription){
            return [];
        }

        return [
            '_active' => 'yep'
        ];
    }
}