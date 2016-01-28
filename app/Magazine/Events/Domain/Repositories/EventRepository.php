<?php


namespace App\Magazine\Events\Domain\Repositories;


use Illuminate\Database\Eloquent\Builder;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;
use MezzoLabs\Mezzo\Core\Modularisation\Domain\Repositories\ModelRepository;
use MezzoLabs\Mezzo\Modules\Addresses\Domain\Repositories\RepositoryWithAddress;

class EventRepository extends ModelRepository
{
    use RepositoryWithAddress;

    public function addScopeBetweenDates(Builder $q1, $from, $to)
    {
        $from = (!empty($from)) ? StringHelper::toDateTimeString($from) : null;
        $to = (!empty($to)) ? StringHelper::toDateTimeString($to) : null;

        return $q1->whereHas('days', function (Builder $q2) use ($from, $to) {
            if ($from && $to) {
                return $q2->where('start', '>', $from)->where('end', '<', $to);
            }

            if ($to) {
                return $q2->where('end', '<', $to);
            }

            return $q2->where('start', '>', $from);
        });
    }
}