<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Schema\InputTypes;


use App\ImageFile;

class GalleryInput extends FilesInput
{
    protected $related = ImageFile::class;
}