<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk;


use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Filesystem\Filesystem as IlluminateFilesystem;
use Illuminate\Support\Str;
use MezzoLabs\Mezzo\Core\Files\StorageFactory;
use MezzoLabs\Mezzo\Core\Traits\IsShared;

class DisksManager
{
    use IsShared;

    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;

    /**
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

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
        $longPathFrom = $this->longPath($disk, $fromPath);
        $longPathTo = $this->longPath($disk, $toPath);

        if($longPathFrom == $longPathTo)
            return true;

        $parts = explode('/', $longPathTo);
        $folderTo = implode('/', array_splice($parts, 0, count($parts) - 1));

        //
        $this->fileSystem()->makeDirectory($folderTo, $mode = 0777, true, true);
        return $this->fileSystem()->move($longPathFrom, $longPathTo);
    }

    /**
     * @param $diskName
     * @param $shortPath
     * @return string
     */
    public function longPath($diskName, $shortPath)
    {
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
     * @return \Illuminate\Contracts\Filesystem\Filesystem|IlluminateFilesystem
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
        $longPath = $this->longPath($diskName, $shortPath);

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
        $longPath = $this->longPath($diskName, $shortPath);

        return $this->fileSystem()->exists($longPath);
    }

    public function url($shortPath, $diskName = "local")
    {
        return $this->urlGenerator->to('mezzo/upload/' . $shortPath);
    }

}