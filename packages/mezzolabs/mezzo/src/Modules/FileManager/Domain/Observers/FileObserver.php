<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\Observers;


use App\File;
use MezzoLabs\Mezzo\Modules\FileManager\Disk\DisksManager;

class FileObserver
{
    /**
     * Triggered before a file gets deleted in the database.
     *
     * @param File $file
     * @return bool
     */
    public function deleting(File $file)
    {
        if(! $file->existsOnDrive())
            return true;


        return $this->disks()->deleteFile($file->shortPath(), $file->getAttribute('disk'));
    }

    protected function disks(){
        return app(DisksManager::class);
    }

    /**
     * Triggered before a file is updated inside the database.
     *
     * @param File $file
     * @return bool|void
     */
    public function updating(File $file)
    {
        if(!$file->isDirty('filename', 'folder') || ! $file->existsOnDrive(true))
            return true;

        $fromPath = $this->disks()->shortPath($file->getOriginal('folder'), $file->getOriginal('filename'));
        $toPath = $this->disks()->shortPath($file->getAttribute('folder'), $file->getAttribute('filename'));

        return $this->disks()->moveFile($fromPath, $toPath);
    }
}