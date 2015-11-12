<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoFile;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\DisksManager;
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
    protected $typeAddon = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasOne(ImageFile::class);
    }

    /**
     * @return TypedFileAddon
     */
    public function typeAddon()
    {
        if ($this->typeAddon === false) {
            $this->typeAddon = $this->findTypeAddon();
        }

        return $this->typeAddon;
    }

    protected function findTypeAddon()
    {
        if($this->fileType()->isImage())
            return ImageFile::findByFile($this);

        return null;
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
     * @param TypedFileAddon $typeAddon
     */
    public function setTypeAddon(TypedFileAddon $typeAddon)
    {
        $this->typeAddon = $typeAddon;
    }

    /**
     * @return string
     */
    public function longPath($useOriginal = false)
    {
        return $this->drives()->longPath($this->disk, $this->shortPath($useOriginal));
    }

    protected function drives()
    {
        return app()->make(DisksManager::class);
    }

    /**
     * @return string
     */
    public function shortPath($useOriginal = false)
    {
        $folder = ($useOriginal) ? $this->getOriginal('folder') : $this->getAttribute('folder');
        $filename = ($useOriginal) ? $this->getOriginal('filename') : $this->getAttribute('filename');

        return $this->drives()->shortPath($folder, $filename);
    }

    public function existsOnDrive($useOriginal = false)
    {
        return $this->drives()->exists($this->disk, $this->shortPath($useOriginal));
    }

    public function url()
    {
        return $this->drives()->url($this->shortPath(), $this->disk);
    }



}
