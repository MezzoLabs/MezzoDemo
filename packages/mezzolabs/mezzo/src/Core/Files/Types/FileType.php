<?php


namespace MezzoLabs\Mezzo\Core\Files\Types;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Cache\Singleton;

abstract class FileType
{
    public static $fileTypes = [
        AudioFileType::class,
        ImageFileType::class,
        VideoFileType::class,
        TextFileType::class
    ];


    /**
     * @var array
     */
    protected $extensions = ["txt"];

    /**
     * @var Collection
     */
    private $extensionCollection;

    /**
     * @var string
     */
    protected $name;


    public function __construct()
    {
        $this->extensionCollection = new Collection();

        foreach ($this->extensions as $extension) {
            $this->extensionCollection->push($this->normExtension($extension));
        }
    }

    /**
     * Check if a extension fits this type of file.
     *
     * @param $extensionToMatch
     * @return bool
     */
    public function matchesExtension($extensionToMatch)
    {
        $extensionToMatch = $this->normExtension($extensionToMatch);

        return $this->extensionCollection->has($extensionToMatch);
    }

    /**
     * Norm the extension to lower case and remove any dots.
     *
     * @param $extension
     * @return mixed
     */
    private function normExtension($extension)
    {
        return str_replace('.', '', strtolower($extension));
    }

    /**
     * Find a FileType based on a extension.
     *
     * @param $extension
     * @return FileType|null
     */
    public static function find($extension)
    {
        foreach (static::$fileTypes as $fileTypeClass) {
            $fileType = static::make();

            if ($fileType->matchesExtension($extension))
                return $fileType;
        }

        return UnknownFileType::make();
    }

    /**
     * @param $fileTypeClass
     * @return static
     */
    public static function make()
    {
        return mezzo()->make(static::class);
    }

    /**
     * @return string
     */
    public function name()
    {
        if (!$this->name) {
            $this->name = strtolower(str_replace('FileType', '', Singleton::reflection($this)->getShortName()));
        }

        return $this->name;

    }


}