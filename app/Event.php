<?php

namespace App;

use App\LockableResources\CanBeLocked;
use App\LockableResources\LockableResource;
use App\Magazine\Relevance\CanBeSortedByRelevance;
use App\Mezzo\Generated\ModelParents\MezzoEvent;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;

class Event extends MezzoEvent implements SluggableInterface, LockableResource
{
    use CanBeSortedByRelevance;

    use SluggableTrait;

    use CanBeLocked;

    public $with = [
        'days'
    ];

    public $searchable = [
        'title', 'description'
    ];

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

    public function scopeNearLocation(Builder $q, $latitude, $longitude, $km = 10)
    {
        $this->repository()->addNearLocationScope($q, $latitude, $longitude, $km);

    }

    public function scopeNearZip(Builder $q, $zip, $km = 10)
    {
        $this->repository()->addNearZipScope($q, $zip, $km);
    }

    public function defaultCreateData($givenData)
    {
        $default = [
            'user_id' => \Auth::id(),
        ];

        if (isset($givenData['event_venue_id'])) {
            $venue = EventVenue::findOrFail($givenData['event_venue_id']);

            $address = (new Collection($venue->address->getAttributes()))
                ->except('id', 'created_at', 'updated_at', 'deleted_at');

            $default['address'] = $address->toArray();
        }

        return $default;
    }

    public function scopeBetweenDates(Builder $q, $from, $to)
    {
        return $this->repository()->addScopeBetweenDates($q, $from, $to);

    }
}
