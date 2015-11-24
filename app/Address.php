<?php
namespace App;


use App\Mezzo\Generated\ModelParents\MezzoAddress;

class Address extends MezzoAddress
{
    public function event()
    {
        return $this->hasOne(Event::class);
    }

    public function eventVenue()
    {
        return $this->hasOne(EventVenue::class);
    }

}