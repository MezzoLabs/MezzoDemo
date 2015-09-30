<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 16:12
 * Project: MezzoDemo
 */
 
 

namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use Doctrine\DBAL\Types\TextType;

class TextArea extends TextInput{
    protected $doctrineType = TextType::class;

    protected $htmlTag = "textarea";
} 