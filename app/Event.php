<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoEvent;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Event extends MezzoEvent implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];

    public function days()
    {
        return $this->hasMany(EventDay::class, 'event_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(EventVenue::class, 'event_venue_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
