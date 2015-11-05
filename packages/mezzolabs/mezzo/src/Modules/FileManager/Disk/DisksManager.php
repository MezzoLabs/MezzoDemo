<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk;


use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Core\Files\StorageFactory;

class DisksManager
{
    public function formattedFileName($baseName, $extension)
    {
        $baseName = str_slug($baseName, '_');

        return $baseName . '.' . $extension;
    }

    /**
     * @param $fromPath
     * @param $fromPath
     * @param $toPath
     * @param string $disk
     * @return bool
     */
    public function moveFile($fromPath, $toPath, $disk = "local")
    {
        $longPathFrom = $this->longPath($fromPath, $disk);
        $longPathTo = $this->longPath($toPath, $disk);

        if($longPathFrom == $longPathTo)
            return true;

        return $this->fileSystem()->move($longPathFrom, $longPathTo);
    }

    /**
     * @param $diskName
     * @param $shortPath
     * @return string
     */
    public function longPath($diskName, $shortPath)
    {
       //TODO: Allow other disks
       return $this->localStoragePath($shortPath);
    }

    /**
     * @param string $path
     * @return string
     */
    public function localStoragePath($path = "")
    {
        return storage_path('mezzo/upload/' . $path);
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    public function fileSystem()
    {
        return StorageFactory::root();
    }

    /**
     * @param $shortPath
     * @param string $diskName
     * @return bool
     */
    public function deleteFile($shortPath, $diskName = "local")
    {
        mezzo_dd('delete file');
        $longPath = $this->longPath($shortPath, $diskName);

        return $this->fileSystem()->delete($longPath);
    }

    /**
     * @param $folder
     * @param $filename
     * @return string
     */
    public function shortPath($folder, $filename){
        $connector = '/';
        if (Str::endsWith($folder, '/'))
            $connector = '';

        return $folder . $connector . $filename;
    }

    public function exists($diskName, $shortPath)
    {
        $longPath = $this->longPath($shortPath, $diskName);
        return $this->fileSystem()->exists($longPath);
    }

}