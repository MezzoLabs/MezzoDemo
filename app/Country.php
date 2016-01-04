<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Country extends Model
{
    public function translatedName()
    {
        $key = 'countries.' . strtolower($this->name);

        if (!Lang::has($key))
            return $this->name;

        return Lang::get($key);
    }
}