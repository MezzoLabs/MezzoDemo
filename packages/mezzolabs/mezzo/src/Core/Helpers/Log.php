<?php


namespace MezzoLabs\Mezzo\Core\Helpers;


use Monolog\Logger;

class Log
{
    /**
     * @var Logger
     */
    protected static $logger;

    public static function logger()
    {
        if(!static::$logger){

            static::$logger = $logger;
            $logger->addInfo("Logger booted");
        }

        return static::$logger;

    }
}