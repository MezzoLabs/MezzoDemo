<?php

namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles;


use MezzoLabs\Mezzo\Core\Files\Types\FileType;

interface TypedFileContract
{
    /**
     * @return FileType
     */
    public function fileType();
}