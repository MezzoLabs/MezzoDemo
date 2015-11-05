<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoFile;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Modules\FileManager\Domain\TypedFiles\TypedFileAddon;

class File extends MezzoFile
{
    /**
     * @var FileType
     */
    protected $fileType;

    /**
     * @var TypedFileAddon
     */
    protected $typeAddon;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasOne(ImageFile::class);
    }

    /**
     * @return FileType|null
     */
    public function fileType()
    {
        if (!$this->fileType)
            $this->fileType = FileType::find($this->extension);

        return $this->fileType;
    }

    /**
     * @return TypedFileAddon
     */
    public function getTypeAddon()
    {
        return $this->typeAddon;
    }

    /**
     * @param TypedFileAddon $typeAddon
     */
    public function setTypeAddon(TypedFileAddon $typeAddon)
    {
        $this->typeAddon = $typeAddon;
    }


}
