<?php

namespace App\Magazine\Events\Http\Requests;


use Illuminate\Http\Exception\HttpResponseException;

trait HandlesEventDays
{
    public function validateDaysNotOverlapping(array $days)
    {
        $i = -1;
        foreach ($days as $day) {
            $i++;

            if(empty($day['start']) || empty($day['end'])) continue;

            $start1 = strtotime($day['start']);
            $end1 = strtotime($day['end']);

            $j = -1;
            foreach ($days as $otherDay) {
                $j++;
                if($i == $j) continue;

                $start2 = strtotime($otherDay['start']);
                $end2 = strtotime($otherDay['end']);

                $overlapping = $this->daysOverlap($start1, $end1, $start2, $end2);

                if($overlapping){
                    $this->overlappingFails($i, $j);
                }

            }
        }

    }

    protected function overlappingFails($day1Index, $day2Index){


        throw new HttpResponseException($this->response([
            'days.' . $day1Index . '.start' => 'Day ' . ($day1Index +1) . ' is overlapping day ' . ($day2Index +1) .'.',
            'days.' . $day1Index . '.end' => 'Day ' . ($day1Index +1) . ' is overlapping day ' . ($day2Index +1) . '.'
        ]));

    }

    public function daysOverlap($start1, $end1, $start2, $end2)
    {
        //Is start 2 inside the first day?
        $startIsOverlapping = $start2 > $start1 && $start2 < $end1;

        //Is end 2 inside the first day?
        $endIsOverlapping = $end2 > $start1 && $end2 < $end1;

        $day1IncludesDay2 = $start1 < $start2 && $end1 > $end2;

        $day2IncludesDay1 = $start2 < $start1 && $end2 > $end1;

        return $startIsOverlapping || $endIsOverlapping || $day1IncludesDay2 || $day2IncludesDay1;
    }
}