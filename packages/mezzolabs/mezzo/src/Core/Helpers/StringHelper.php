<?php


namespace MezzoLabs\Mezzo\Core\Helpers;


class StringHelper
{
    const DATETIME_LOCAL = 'Y-m-d\TH:i:s';

    public static function fromArrayToDotNotation($arrayNotation)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $arrayNotation);
    }

    public static function datetimeLocal($date)
    {
        if (!$date instanceof \Carbon\Carbon)
            $date = new \Carbon\Carbon($date);

        return $date->format(static::DATETIME_LOCAL);
    }
}