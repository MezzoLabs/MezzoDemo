<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Domain\Observers;


use App\File;

class FileObserver
{
    public function deleting(File $file)
    {

    }

    public function deleted(File $file)
    {
        
    }

    public function updating(File $file)
    {
        mezzo_dd('updatting');
    }
}