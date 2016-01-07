<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEventProvider;

class EventProvider extends MezzoEventProvider
{
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
