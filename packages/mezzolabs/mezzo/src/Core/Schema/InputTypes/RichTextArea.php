<?php


namespace MezzoLabs\Mezzo\Core\Schema\InputTypes;


class RichTextArea extends TextArea
{
    protected $htmlAttributes = [
        'data-mezzo-richtext' => 1
    ];

} 