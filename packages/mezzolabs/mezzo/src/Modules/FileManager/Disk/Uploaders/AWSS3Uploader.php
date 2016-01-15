<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Uploaders;


use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AwsS3Uploader extends AbstractFileUploader
{

    /**
     * Returns the default
     *
     * @return Filesystem
     */
    public function fileSystem()
    {
        return Storage::disk('s3');
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
        return $this->fileSystem()->put($path,  file_get_contents($file));
    }

    public function key() : string
    {
        return 's3';
    }
}