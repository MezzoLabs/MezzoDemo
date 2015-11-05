<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk;


use App\File;

class DiskSynchronization
{
    public function __construct()
    {

    }

    public function setListeners()
    {
        File::deleting(function(File $file){
            echo 'fire';
            return $this->removeFromDisk($file);
        });

        File::updating(function(File $file){
            return $this->moveOnDisk($file);
        });
    }

    /**
     * Remove the file from the disk before it is deleted on the database.
     *
     * @param $file
     */
    protected function removeFromDisk(File $file)
    {
        mezzo_dd($file);
        return $this->disks()->deleteFile($file->shortPath(), $file->disk);

    }

    /**
     * @return DisksManager
     */
    protected function disks(){
        return app(DisksManager::class);
    }

    /**
     * @param $file
     * @return bool
     */
    protected function moveOnDisk(File $file)
    {
    }
}