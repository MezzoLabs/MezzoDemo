<?php


namespace MezzoLabs\Mezzo\Modules\FileManager\Disk\Publishers;


use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Http\Responses\ModuleResponseFactory;

abstract class AbstractFilePublisher
{
    /**
     * @var \App\File
     */
    protected $file;
    /**
     * @var Collection
     */
    protected $options;

    final public function __construct(\App\File $file, array $options)
    {
        $this->file = $file;
        $this->options = new Collection($options);
    }

    /**
     * @return Collection
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * @return \App\File
     */
    public function file()
    {
        return $this->file;
    }

    public function forceDownload()
    {
        return $this->options()->get('forceDownload');
    }

    public function imageSizeKey()
    {
        return $this->options()->get('imageSize', 'medium');
    }

    public function response()
    {
        return app(ModuleResponseFactory::class);
    }
}