<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoFile;
use MezzoLabs\Mezzo\Core\Files\Types\FileType;
use MezzoLabs\Mezzo\Core\Helpers\StringHelper;
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
    public function absolutePath($useOriginal = false)
    {
        return $this->disks()->absolutePath($this->disk, $this->shortPath($useOriginal));
    }

    public function sourcePath()
    {
        return $this->disks()->sourcePath($this->disk, $this->shortPath());
    }

    protected function disks()
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

        return ltrim(StringHelper::path($folder, $filename), '/');
    }

    public function existsOnDrive($useOriginal = false)
    {
        return $this->disks()->exists($this->disk, $this->shortPath($useOriginal));
    }

    public function url()
    {
        return $this->disks()->url($this->shortPath(), $this->disk);
    }

    /**
     * @param $to
     * @return bool
     */
    public function move($to)
    {
        $parts = explode('/', $to);
        $toName = $parts[count($parts) - 1];
        $toFolder = implode('/', array_splice($parts, 0, count($parts) - 1));

        $this->filename = $toName;
        $this->folder = $toFolder;

        return $this->save();
    }



}
