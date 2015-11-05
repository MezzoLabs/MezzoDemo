<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoFile;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;

class File extends MezzoFile
{
    /**
     * @var FileType
     */
    protected $fileType;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ImageFile::class);
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
}
