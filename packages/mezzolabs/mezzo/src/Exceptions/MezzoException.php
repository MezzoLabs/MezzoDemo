<?php


namespace MezzoLabs\Mezzo\Exceptions;


use MezzoLabs\Mezzo\Core\Modularisation\ModuleProvider;

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
}