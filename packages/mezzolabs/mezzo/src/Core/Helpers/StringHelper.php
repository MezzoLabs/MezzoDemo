<?php


namespace MezzoLabs\Mezzo\Core\Helpers;


class StringHelper
{
    public static function fromArrayToDotNotation($arrayNotation)
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $arrayNotation);
    }
}