<?php


namespace MezzoLabs\Mezzo\Core\Logging;


class Logger extends \Monolog\Logger
{


    /**
     * @return Logger
     */
    public static function make()
    {
        return app()->make(static::class);
    }
}