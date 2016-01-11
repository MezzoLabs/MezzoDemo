<?php

namespace App;

use App\LockableResources\CanBeLocked;
use App\LockableResources\LockableResource;
use App\Magazine\Relevance\CanBeSortedByRelevance;
use App\Mezzo\Generated\ModelParents\MezzoEvent;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Event extends MezzoEvent implements SluggableInterface, LockableResource
{
    use CanBeSortedByRelevance;

    use SluggableTrait;

    use CanBeLocked;

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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return Carbon
     */
    public function start()
    {
        return $this->days->sortBy('start')->first()->start;
    }

    /**
     * @return Carbon
     */
    public function end()
    {
        return $this->days->sortBy('end')->last()->end;
    }


    public function lockedBy()
    {
        return $this->belongsTo(User::class, 'locked_by_id', 'id');
    }

    public function eventProvider()
    {
        return $this->belongsTo(EventProvider::class);
    }

    public function scopeNearLocation($latitude, $longitude, $km)
    {
        return $this->whereHas('address', function ($q) use ($latitude, $longitude, $km){
            $q->where('latitude', '=', $latitude)
                ->where('longitude', '=', $longitude )
                ->where('longitude', '=', $km );

        })->get();
    }
}
