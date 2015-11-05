<?php

namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles;


use MezzoLabs\Mezzo\Core\Files\Types\FileType;

interface TypedFileAddon
{
    /**
     * @return FileType
     */
    public function fileType();
}