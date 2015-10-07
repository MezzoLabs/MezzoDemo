<?php


namespace MezzoLabs\Mezzo\Exceptions;


class InvalidArgumentException extends MezzoException
{

    /**
     * You can only make a modelWrapper out of a class name (string) or out of an existing modelWrapper
     *
     * @param string|object $invalidArgument
     * @internal param string $notAModel
     * @internal param ModelWrapper $model
     * @internal param ModuleProvider $module
     */
    public function  __construct($invalidArgument)
    {
        $type = gettype($invalidArgument);

        if ($type === 'object')
            $type = get_class($invalidArgument);

        $this->message = $type . ' is an invalid argument for ' . $this->getCallingFunction() . '.';
    }
} 