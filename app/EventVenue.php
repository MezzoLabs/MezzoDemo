<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEventVenue;

class EventVenue extends MezzoEventVenue
{
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
