<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Systems;


use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class AwsS3Disk implements DiskSystemContract
{

    /**
     * Move a file from one path to another.
     *
     * @param string $from
     * @param string $to
     * @return bool
     */
    public function move(string $from, string $to) : bool
    {
        return $this->fileSystem()->move($from, $to);
    }

    /**
     * Remove a file from this path.
     *
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        return $this->fileSystem()->delete($path);
    }

    /**
     * Check if there is a file on the given path.
     *
     * @param string $path
     * @return bool
     */
    public function exists(string $path) : bool
    {
        return $this->fileSystem()->exists($path);
    }

    /**
     * Returns the absolute path of a file.
     * This is needed when you want a base folder that doesnt appear in the database representation.
     *
     * @param string $path
     * @return string
     */
    public function absolutePath(string $path) : string
    {
        return $path;
    }

    /**
     * Returns the according Illuminate filesystem for this disk.
     *
     * @return Filesystem
     */
    public function fileSystem() : Filesystem
    {
        return Storage::disk('s3');
    }
}