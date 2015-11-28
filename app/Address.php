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

    public function getLabelAttribute()
    {
        $array = [
            $this->addressee,
            $this->street,
            $this->street_extra,
            $this->zip,
            $this->city,
            $this->country
        ];


        return implode(' ', array_filter($array));
    }

}