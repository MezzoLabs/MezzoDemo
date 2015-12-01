<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEventVenue;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class EventVenue extends MezzoEventVenue implements SluggableInterface
{
    use SluggableTrait;

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
