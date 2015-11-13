<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Content\Fields;


use MezzoLabs\Mezzo\Modules\Contents\FieldTypes\AbstractContentFieldType;
use MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes\ImageInput;

class ImageField extends AbstractContentFieldType
{
    protected $inputType = ImageInput::class;
}