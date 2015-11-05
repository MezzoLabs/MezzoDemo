<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoImageFile;
use MezzoLabs\Mezzo\Core\Files\Types\ImageFileType;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\IsFileWithType;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\TypedFileAddon;

class ImageFile extends MezzoImageFile implements TypedFileAddon
{
    use IsFileWithType;

    protected $fileType = ImageFileType::class;

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
