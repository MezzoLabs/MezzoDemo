<?php

namespace App;

use App\LockableResources\CanBeLocked;
use App\LockableResources\LockableResource;
use App\Magazine\Relevance\CanBeSortedByRelevance;
use App\Mezzo\Generated\ModelParents\MezzoEvent;
use Auth;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Data that will be added to the request if the field is empty
     *
     * @param array $requestData
     * @return array
     */
    public function defaultData(array $requestData) : array
    {
        return [
            'user_id' => Auth::id()
        ];
    }

    public function scopeBetweenDates(Builder $q, $from, $to = "")
    {
        return $this->repository()->addScopeBetweenDates($q, $from, $to);

    }
}
