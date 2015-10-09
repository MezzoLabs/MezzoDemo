<?php


namespace MezzoLabs\Mezzo\Core\Annotations\Reader;


use Doctrine\Common\Annotations\FileCacheReader;
use Doctrine\Common\Annotations\AnnotationReader as DoctrineAnnotationReader;
use Doctrine\Common\Annotations\Reader as ReaderInterface;
use Illuminate\Support\Collection;
use MezzoLabs\Mezzo\Core\Reflection\Reflections\ModelReflection;
use MezzoLabs\Mezzo\Core\Schema\ModelSchema;

class AnnotationReader
{
    /**
     * @var Collection
     */
    protected $modelAnnotationsCache;

    /**
     * @var bool
     */
    protected $debug = true;

    /**
     * @var string
     */
    protected $cacheStorage = 'doctrineAnnotations';

    /**
     * @var ReaderInterface
     */
    protected $doctrineReader;

    public function __construct()
    {
        $this->modelAnnotationsCache = new Collection();

        $this->doctrineReader = $this->makeDoctrineAnnotationReader();
    }

    /**
     * @return ReaderInterface
     */
    protected function makeDoctrineAnnotationReader(){
        //@TODO-SCHS: Move to CachedReader

        return new FileCacheReader(
            new DoctrineAnnotationReader(),
            storage_path('app/') . $this->cacheStorage,
            $this->debug
        );
    }

    public function model(ModelReflection $modelReflection)
    {
        if($this->modelAnnotationsCache->has($modelReflection->className()))
            return $this->modelAnnotationsCache->get($modelReflection->className());

        return new ModelAnnotations($modelReflection);
    }

    /**
     * @param ModelAnnotations $modelAnnotations
     */
    public function cache(ModelAnnotations $modelAnnotations)
    {
        $this->modelAnnotationsCache->put($modelAnnotations->name(), $modelAnnotations);
    }

    /**
     * @return ReaderInterface
     */
    public function doctrineReader()
    {
        return $this->doctrineReader;
    }
}