<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEventDay;

class EventDay extends MezzoEventDay
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
