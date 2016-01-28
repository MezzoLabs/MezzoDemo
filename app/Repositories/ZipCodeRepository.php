<?php

namespace App\Repositories;


use DB;

class ZipCodeRepository
{
    public function findGeoData($zip)
    {
        $zip = DB::table('zipcodes')
            ->select('latitude', 'longitude')
            ->where('zip', '=', $zip)
            ->first();

        return $zip;
    }
}