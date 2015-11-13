<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes;


use App\ImageFile;
use Doctrine\DBAL\Types\Type;
use MezzoLabs\Mezzo\Core\Schema\InputTypes\RelationInputSingle;

class ImageInput extends RelationInputSingle
{
    protected $doctrineType = Type::INTEGER;

    protected $related = ImageFile::class;
}