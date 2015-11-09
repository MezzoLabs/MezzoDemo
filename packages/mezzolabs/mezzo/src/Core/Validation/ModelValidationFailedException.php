<?php


namespace MezzoLabs\Mezzo\Core\Validation;


use Illuminate\Validation\Validator as IllumniateValidator;
use MezzoLabs\Mezzo\Exceptions\MezzoException;

class ModelValidationFailedException extends MezzoException
{
    public function __construct(IllumniateValidator $validator)
    {
        $this->add("Model validation failed:");


        foreach($validator->messages()->getMessages() as $message){

            $this->add($message[0]);
        }
    }
}