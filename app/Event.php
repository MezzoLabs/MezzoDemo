<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEvent;

class Event extends MezzoEvent
{
    public function days()
    {
        return $this->hasMany(EventDay::class, 'event_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(EventVenue::class, 'event_venue_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
