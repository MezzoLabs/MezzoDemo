<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Uploaders;


use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
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
        return Storage::disk('local');
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
        $saved = $file->move('mezzo/upload/' . $path);
        return $saved;
    }
}