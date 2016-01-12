<?php
/**
 * Created by: simon.schneider
 * Date: 16.09.2015 - 16:12
 * Project: MezzoDemo
 */


namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


use Doctrine\DBAL\Types\Type;

class RichTextArea extends TextArea
{
    protected $htmlAttributes = [
        'data-mezzo-richtext' => 1
    ];

} 