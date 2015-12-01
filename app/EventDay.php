<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEventDay;

class EventDay extends MezzoEventDay
{
    protected $dates = [
        'start',
        'end'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
