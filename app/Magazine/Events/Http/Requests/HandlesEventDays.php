<?php

namespace App\Magazine\Events\Http\Requests;


use Illuminate\Http\Exception\HttpResponseException;

trait HandlesEventDays
{


    protected function overlappingFails($day1Index, $day2Index){

        throw new HttpResponseException($this->response([
            'days.' . $day1Index . '.start' => 'Day ' . ($day1Index +1) . ' is overlapping day ' . ($day2Index +1) .'.',
            'days.' . $day1Index . '.end' => 'Day ' . ($day1Index +1) . ' is overlapping day ' . ($day2Index +1) . '.'
        ]));

    }


}