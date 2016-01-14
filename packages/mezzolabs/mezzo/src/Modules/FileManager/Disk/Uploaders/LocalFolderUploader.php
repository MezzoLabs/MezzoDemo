<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Uploaders;


use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\Filesystem as IlluminateFileSystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LocalFolderUploader extends AbstractFileUploader
{

    /**
     * Returns the default
     *
     * @return Filesystem
     */
    public function fileSystem() : Filesystem
    {
        return mezzo()->make(IlluminateFileSystem::class);
    }

    /**
     * Upload a file to the disk onto a given path.
     *
     * @param $path
     * @param UploadedFile $file
     * @return bool
     */
    public function upload($path, UploadedFile $file) : bool
    {
        return $this->moveFile($file, $path);
    }

    /**
     * Move the uploaded file to its destination
     *
     * @param UploadedFile $file
     * @param $path
     * @return bool
     */
    protected function moveFile(UploadedFile $file, $path) : bool
    {
        $saved = $file->move(storage_path('mezzo/upload/' . $path));
        return $saved == true;
    }

    public function key() : string
    {
        return 'local';
    }
}