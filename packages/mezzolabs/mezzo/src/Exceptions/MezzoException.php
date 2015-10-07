<?php


namespace MezzoLabs\Mezzo\Exceptions;


class MezzoException extends \Exception
{
    /**
     * Add a line of text to the message
     *
     * @param $string
     */
    protected function add($string = "")
    {
        $this->message .= $string . "\n";
    }

    /**
     * @return array
     */
    protected function getTraceEnd()
    {
        return $this->getTrace()[0];
    }

    protected function getCallingFunction()
    {
        return $this->getTraceEnd()['function'];
    }
}